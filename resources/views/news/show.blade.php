@extends('layouts.app')

@section('title', $article->meta_title ?: $article->title)
@section('meta_description', $article->meta_description ?: Str::limit(strip_tags($article->content), 150))

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        {{-- Main Article --}}
        <div class="lg:col-span-8">
            <article class="bg-surface rounded-3xl shadow-card border border-border overflow-hidden">
                @if($article->cover_image)
                    <div class="w-full aspect-[21/9] md:aspect-[16/6] bg-background">
                        <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
                
                <div class="p-6 md:p-10">
                    <div class="flex flex-wrap items-center gap-4 text-sm text-text-light mb-6">
                        <span class="flex items-center gap-1.5 px-3 py-1 bg-background rounded-full border border-border">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $article->published_at->translatedFormat('l, d F Y') }}
                        </span>
                        @if($article->author)
                            <span class="flex items-center gap-1.5 px-3 py-1 bg-background rounded-full border border-border">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Ditulis oleh: <span class="font-medium text-text">{{ $article->author->name }}</span>
                            </span>
                        @endif
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-8 leading-tight">{{ $article->title }}</h1>
                    
                    <div class="prose prose-lg max-w-none text-text-light prose-headings:font-heading prose-headings:font-bold prose-headings:text-heading prose-a:text-primary prose-a:no-underline hover:prose-a:underline prose-img:rounded-xl">
                        {!! $article->content !!}
                    </div>

                    {{-- Share Buttons --}}
                    <div class="mt-12 pt-8 border-t border-border">
                        <h4 class="font-heading font-semibold text-heading mb-4">Bagikan Artikel Ini:</h4>
                        <div class="flex items-center gap-3">
                            @php
                                $shareUrl = urlencode(request()->url());
                                $shareTitle = urlencode($article->title);
                            @endphp
                            <a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-accent/10 text-accent hover:bg-accent hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.312h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-sky-100 text-sky-500 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        {{-- Sidebar: Berita Terbaru --}}
        <div class="lg:col-span-4">
            <div class="sticky top-28 bg-surface rounded-2xl shadow-subtle border border-border p-6">
                <h3 class="font-heading font-bold text-lg text-heading mb-4 pb-4 border-b border-border">Berita Terbaru Lainnya</h3>
                
                @if($recentNews->count() > 0)
                    <div class="space-y-6">
                        @foreach($recentNews as $recent)
                            <a href="{{ route('news.show', $recent->slug) }}" class="group flex gap-4 items-start">
                                <div class="w-20 h-20 shrink-0 bg-background rounded-lg overflow-hidden relative">
                                    @if($recent->cover_image)
                                        <img src="{{ $recent->cover_image_url }}" alt="{{ $recent->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-border">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-heading font-semibold text-sm text-heading group-hover:text-primary transition-colors line-clamp-2 leading-tight mb-1">{{ $recent->title }}</h4>
                                    <p class="text-xs text-text-light">{{ $recent->published_at->translatedFormat('d M Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-6 pt-4 border-t border-border">
                        <a href="{{ route('news.index') }}" class="text-sm font-medium text-primary hover:text-primary-dark transition-colors inline-flex items-center gap-2">
                            Lihat Semua Berita <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                @else
                    <p class="text-sm text-text-light text-center py-4">Belum ada berita lainnya.</p>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
