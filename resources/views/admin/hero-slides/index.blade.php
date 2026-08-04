@extends('admin.layouts.app')
@section('title', 'Hero Slider')
@section('page-title', 'Hero Slider')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-heading text-xl font-bold text-heading">Hero Slider Beranda</h2>
            <p class="text-sm text-text-light mt-1">Kelola slide carousel di halaman beranda</p>
        </div>
        <a href="{{ route('admin.hero-slides.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Slide
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($slides as $slide)
            <div class="bg-surface rounded-xl shadow-card overflow-hidden">
                <div class="aspect-video bg-background relative overflow-hidden">
                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                    <div class="absolute top-2 left-2 flex items-center gap-2">
                        <span class="px-2 py-0.5 text-xs font-medium rounded-md {{ $slide->is_active ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                            {{ $slide->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <span class="px-2 py-0.5 text-xs font-medium rounded-md bg-black/60 text-white">#{{ $slide->sort_order }}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-heading font-semibold text-heading truncate">{{ $slide->title ?? 'Tanpa Judul' }}</h3>
                    <p class="text-xs text-text-light mt-0.5 truncate">{{ $slide->subtitle ?? '—' }}</p>
                    @if($slide->cta_text)
                        <p class="text-xs text-primary mt-1">CTA: {{ $slide->cta_text }}</p>
                    @endif
                    <div class="flex items-center gap-2 mt-3">
                        <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="flex-1 text-center py-2 bg-background text-text text-xs font-medium rounded-lg hover:bg-border transition-fast">Edit</a>
                        <form method="POST" action="{{ route('admin.hero-slides.destroy', $slide) }}" class="form-delete flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full py-2 bg-red-50 text-danger text-xs font-medium rounded-lg hover:bg-red-100 transition-fast">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface rounded-xl shadow-card p-12 text-center text-text-light">
                <p>Belum ada slide. <a href="{{ route('admin.hero-slides.create') }}" class="text-primary hover:underline">Tambah slide pertama</a></p>
            </div>
        @endforelse
    </div>
</div>
@endsection
