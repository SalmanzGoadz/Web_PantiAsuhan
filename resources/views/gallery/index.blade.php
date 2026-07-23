@extends('layouts.app')

@section('title', 'Galeri Kegiatan')
@section('meta_description', 'Dokumentasi album foto kegiatan, program, dan keseharian anak-anak Panti Asuhan Muhammadiyah Semarang.')

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-4">Galeri Kegiatan</h1>
        <p class="text-text-light text-lg max-w-2xl mx-auto">Momen-momen berharga dan dokumentasi aktivitas di lingkungan panti asuhan kami.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @forelse($galleries as $gallery)
            <a href="{{ route('gallery.show', $gallery->slug) }}" class="group block relative rounded-2xl overflow-hidden aspect-[4/3] bg-background shadow-subtle hover:shadow-card transition-shadow">
                @if($gallery->cover_image)
                    <img src="{{ $gallery->cover_image_url }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                    <div class="w-full h-full flex items-center justify-center text-border">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute inset-0 p-6 flex flex-col justify-end">
                    <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-medium rounded-full mb-3 self-start">
                        {{ $gallery->items_count ?? $gallery->items()->count() }} Foto
                    </span>
                    <h3 class="font-heading font-bold text-xl text-white mb-1 group-hover:text-primary-100 transition-colors">
                        {{ $gallery->title }}
                    </h3>
                    <p class="text-sm text-white/80 line-clamp-2">
                        {{ $gallery->description }}
                    </p>
                </div>
            </a>
        @empty
            <div class="col-span-full py-16 text-center text-text-light">
                <svg class="w-16 h-16 mx-auto mb-4 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p class="text-lg">Belum ada album galeri yang tersedia.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($galleries->hasPages())
        <div class="mt-12">
            {{ $galleries->links() }}
        </div>
    @endif

</div>

@endsection
