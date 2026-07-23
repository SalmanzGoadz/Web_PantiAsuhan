<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\ActivityLog;
use App\Models\Gallery;
use App\Models\GalleryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index(Request $request): View
    {
        $query = Gallery::withCount('items')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $galleries = $query->paginate(15)->withQueryString();

        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery.
     */
    public function create(): View
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created gallery.
     */
    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Generate slug
        $data['slug'] = Str::slug($data['title']);
        $data['slug'] = $this->ensureUniqueSlug($data['slug']);

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('galleries/covers', 'public');
        }

        $gallery = Gallery::create($data);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('galleries/items', 'public');
                GalleryItem::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $path,
                    'caption' => $request->input("captions.{$index}"),
                    'sort_order' => $index,
                ]);
            }
        }

        ActivityLog::log('created', $gallery, "Membuat album galeri: {$gallery->title}");

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Album galeri berhasil dibuat.');
    }

    /**
     * Show gallery details with all items for editing.
     */
    public function edit(Gallery $gallery): View
    {
        $gallery->load('items');

        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        // Update slug if title changed
        if ($data['title'] !== $gallery->title) {
            $data['slug'] = Str::slug($data['title']);
            $data['slug'] = $this->ensureUniqueSlug($data['slug'], $gallery->id);
        }

        // Handle cover image
        if ($request->hasFile('cover_image')) {
            if ($gallery->cover_image) {
                Storage::disk('public')->delete($gallery->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')
                ->store('galleries/covers', 'public');
        }

        $gallery->update($data);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $maxOrder = $gallery->items()->max('sort_order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('galleries/items', 'public');
                GalleryItem::create([
                    'gallery_id' => $gallery->id,
                    'image_path' => $path,
                    'caption' => $request->input("captions.{$index}"),
                    'sort_order' => $maxOrder + $index + 1,
                ]);
            }
        }

        ActivityLog::log('updated', $gallery, "Mengubah album galeri: {$gallery->title}");

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Album galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified gallery and all its items.
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        $title = $gallery->title;

        // Delete all item images
        foreach ($gallery->items as $item) {
            Storage::disk('public')->delete($item->image_path);
        }

        // Delete cover image
        if ($gallery->cover_image) {
            Storage::disk('public')->delete($gallery->cover_image);
        }

        ActivityLog::log('deleted', $gallery, "Menghapus album galeri: {$title}");

        $gallery->delete(); // cascade deletes items via FK

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Album galeri berhasil dihapus.');
    }

    /**
     * Delete a single gallery item.
     */
    public function destroyItem(GalleryItem $item): RedirectResponse
    {
        $gallery = $item->gallery;

        Storage::disk('public')->delete($item->image_path);
        $item->delete();

        ActivityLog::log('deleted', $gallery, "Menghapus foto dari album: {$gallery->title}");

        return redirect()
            ->route('admin.galleries.edit', $gallery)
            ->with('success', 'Foto berhasil dihapus.');
    }

    /**
     * Update caption for a gallery item (AJAX).
     */
    public function updateItem(Request $request, GalleryItem $item): RedirectResponse
    {
        $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
        ]);

        $item->update(['caption' => $request->caption]);

        return redirect()
            ->route('admin.galleries.edit', $item->gallery)
            ->with('success', 'Caption berhasil diperbarui.');
    }

    /**
     * Ensure the slug is unique.
     */
    private function ensureUniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $original = $slug;
        $count = 1;

        while (Gallery::where('slug', $slug)
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }
}
