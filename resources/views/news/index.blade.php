@extends('layouts.app')

@section('title', 'Berita & Artikel')
@section('meta_description', 'Berita terbaru, kegiatan, dan artikel inspiratif dari Panti Asuhan Muhammadiyah Semarang.')

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-3">Berita & Artikel</h1>
                <p class="text-text-light text-lg">Ikuti terus perkembangan, kegiatan, dan cerita dari kami.</p>
            </div>
            
            {{-- Search Bar --}}
            <div class="w-full md:w-80 shrink-0">
                <form action="{{ route('news.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita..." 
                           class="w-full pl-11 pr-4 py-3 bg-background border border-border rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    <svg class="w-5 h-5 text-text-light absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    
    @if(request('search'))
        <div class="mb-8">
            <p class="text-text-light">Menampilkan hasil pencarian untuk: <span class="font-semibold text-heading">"{{ request('search') }}"</span></p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($news as $article)
            <article class="bg-surface rounded-2xl overflow-hidden shadow-subtle border border-border hover:shadow-card transition-shadow group flex flex-col">
                <a href="{{ route('news.show', $article->slug) }}" class="block aspect-video overflow-hidden relative bg-background">
                    @if($article->cover_image)
                        <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex items-center gap-4 text-xs text-text-light mb-3">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $article->published_at->translatedFormat('d M Y') }}
                        </span>
                        @if($article->author)
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ $article->author->name }}
                            </span>
                        @endif
                    </div>
                    <h3 class="font-heading font-bold text-xl text-heading mb-3 group-hover:text-primary transition-colors">
                        <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                    </h3>
                    <p class="text-sm text-text-light line-clamp-3 mb-6 flex-grow">
                        {{ $article->excerpt ?: Str::words(strip_tags($article->content), 20) }}
                    </p>
                    <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center gap-2 font-medium text-primary hover:text-primary-dark transition-colors mt-auto">
                        Baca Artikel
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </article>
        @empty
            <div class="col-span-full py-16 text-center text-text-light">
                <svg class="w-16 h-16 mx-auto mb-4 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2"/></svg>
                <p class="text-lg">Belum ada berita atau artikel yang ditemukan.</p>
                @if(request('search'))
                    <a href="{{ route('news.index') }}" class="inline-block mt-4 text-primary font-medium hover:underline">Tampilkan semua berita</a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($news->hasPages())
        <div class="mt-12">
            {{ $news->links() }}
        </div>
    @endif

</div>

@endsection
