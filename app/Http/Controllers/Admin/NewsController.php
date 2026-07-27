<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\UpdateNewsRequest;
use App\Models\ActivityLog;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * Display a listing of news.
     */
    public function index(Request $request): View
    {
        $query = News::with('author')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $news = $query->paginate(15)->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new news article.
     */
    public function create(): View
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created news article.
     */
    public function store(StoreNewsRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Jika tanggal publish kosong, isi dengan waktu saat ini
        $data['published_at'] = $data['published_at'] ?? now();

        // Handle slug generation
        $data['slug'] = Str::slug($data['title']);
        $data['slug'] = $this->ensureUniqueSlug($data['slug']);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('news/covers', 'public');
        }

        $data['author_id'] = auth()->id();

        $news = News::create($data);

        ActivityLog::log('created', $news, "Membuat berita: {$news->title}");

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified news article.
     */
    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified news article.
     */
    public function update(UpdateNewsRequest $request, News $news): RedirectResponse
    {
        $data = $request->validated();

        // Jika tanggal publish kosong, isi dengan waktu saat ini
        $data['published_at'] = $data['published_at'] ?? now();

        // Handle slug update if title changed
        if ($data['title'] !== $news->title) {
            $data['slug'] = Str::slug($data['title']);
            $data['slug'] = $this->ensureUniqueSlug($data['slug'], $news->id);
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($news->cover_image) {
                Storage::disk('public')->delete($news->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')
                ->store('news/covers', 'public');
        }

        $news->update($data);

        ActivityLog::log('updated', $news, "Mengubah berita: {$news->title}");

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified news article.
     */
    public function destroy(News $news): RedirectResponse
    {
        $title = $news->title;

        // Delete cover image
        if ($news->cover_image) {
            Storage::disk('public')->delete($news->cover_image);
        }

        ActivityLog::log('deleted', $news, "Menghapus berita: {$title}");

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Ensure the slug is unique.
     */
    private function ensureUniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $original = $slug;
        $count = 1;

        while (News::where('slug', $slug)
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }
}
