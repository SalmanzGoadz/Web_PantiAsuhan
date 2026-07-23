<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHeroSlideRequest;
use App\Http\Requests\Admin\UpdateHeroSlideRequest;
use App\Models\ActivityLog;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    /**
     * Display a listing of hero slides.
     */
    public function index(): View
    {
        $slides = HeroSlide::ordered()->get();

        return view('admin.hero-slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new slide.
     */
    public function create(): View
    {
        return view('admin.hero-slides.create');
    }

    /**
     * Store a newly created slide.
     */
    public function store(StoreHeroSlideRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('hero-slides', 'public');
        }

        // Set sort order to last
        $data['sort_order'] = (HeroSlide::max('sort_order') ?? 0) + 1;

        $slide = HeroSlide::create($data);

        ActivityLog::log('created', $slide, "Menambah hero slide: {$slide->title}");

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Hero slide berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified slide.
     */
    public function edit(HeroSlide $heroSlide): View
    {
        return view('admin.hero-slides.edit', ['slide' => $heroSlide]);
    }

    /**
     * Update the specified slide.
     */
    public function update(UpdateHeroSlideRequest $request, HeroSlide $heroSlide): RedirectResponse
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($heroSlide->image) {
                Storage::disk('public')->delete($heroSlide->image);
            }
            $data['image'] = $request->file('image')
                ->store('hero-slides', 'public');
        }

        $heroSlide->update($data);

        ActivityLog::log('updated', $heroSlide, "Mengubah hero slide: {$heroSlide->title}");

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Hero slide berhasil diperbarui.');
    }

    /**
     * Remove the specified slide.
     */
    public function destroy(HeroSlide $heroSlide): RedirectResponse
    {
        $title = $heroSlide->title;

        if ($heroSlide->image) {
            Storage::disk('public')->delete($heroSlide->image);
        }

        ActivityLog::log('deleted', $heroSlide, "Menghapus hero slide: {$title}");

        $heroSlide->delete();

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Hero slide berhasil dihapus.');
    }

    /**
     * Reorder slides via form submission.
     */
    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'exists:hero_slides,id'],
        ]);

        foreach ($request->order as $position => $id) {
            HeroSlide::where('id', $id)->update(['sort_order' => $position]);
        }

        ActivityLog::log('updated', null, 'Mengubah urutan hero slides');

        return redirect()
            ->route('admin.hero-slides.index')
            ->with('success', 'Urutan slide berhasil diperbarui.');
    }
}
