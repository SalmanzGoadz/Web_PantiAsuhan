@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')
@section('page-title', 'Manajemen Galeri')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-heading text-xl font-bold text-heading">Album Galeri</h2>
            <p class="text-sm text-text-light mt-1">Kelola album foto kegiatan</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Album
        </a>
    </div>

    {{-- Search --}}
    <div class="bg-surface rounded-xl shadow-card p-4">
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari album..."
                   class="flex-1 px-4 py-2 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            <button type="submit" class="px-4 py-2 bg-background text-text text-sm font-medium rounded-lg hover:bg-border transition-fast">Cari</button>
        </form>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galleries as $gallery)
            <div class="bg-surface rounded-xl shadow-card overflow-hidden group">
                <div class="aspect-video bg-background relative overflow-hidden">
                    @if($gallery->cover_image)
                        <img src="{{ $gallery->cover_image_url }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-default">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 bg-black/60 text-white text-xs rounded-md">{{ $gallery->items_count }} foto</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-heading font-semibold text-heading truncate">{{ $gallery->title }}</h3>
                    <p class="text-xs text-text-light mt-1">{{ $gallery->published_at ? $gallery->published_at->format('d M Y') : 'Belum dipublish' }}</p>
                    <div class="flex items-center gap-2 mt-3">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="flex-1 text-center py-2 bg-background text-text text-xs font-medium rounded-lg hover:bg-border transition-fast">Edit</a>
                        <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" class="form-delete flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full py-2 bg-red-50 text-danger text-xs font-medium rounded-lg hover:bg-red-100 transition-fast">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-surface rounded-xl shadow-card p-12 text-center text-text-light">
                <svg class="w-12 h-12 mx-auto mb-3 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/></svg>
                <p>Belum ada album. <a href="{{ route('admin.galleries.create') }}" class="text-primary hover:underline">Buat album pertama</a></p>
            </div>
        @endforelse
    </div>

    @if($galleries->hasPages())
        <div>{{ $galleries->links() }}</div>
    @endif
</div>
@endsection
