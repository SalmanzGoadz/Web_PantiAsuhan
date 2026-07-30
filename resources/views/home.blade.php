@extends('layouts.app')

@section('title', \App\Models\SiteSetting::get('site_name', 'Beranda'))
@section('meta_description', \App\Models\SiteSetting::get('site_description', ''))

@section('content')

{{-- 1. Hero Carousel --}}
<section class="relative bg-background overflow-hidden" x-data="heroCarousel()">
    <div class="relative h-[60vh] min-h-[400px] md:h-[70vh] lg:h-[80vh]">
        @forelse($slides as $index => $slide)
            <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
                 :class="{ 'opacity-100 z-10': activeSlide === {{ $index }}, 'opacity-0 z-0': activeSlide !== {{ $index }} }">
                {{-- Image Background --}}
                <div class="absolute inset-0 bg-gray-900">
                    <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" class="w-full h-full object-cover opacity-60">
                </div>
                {{-- Content --}}
                <div class="relative z-20 h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-center">
                    <div class="max-w-3xl animate-fade-in-up" x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                        <h1 class="text-3xl md:text-5xl lg:text-6xl font-heading font-bold text-white leading-tight mb-4 drop-shadow-lg">
                            {{ $slide->title }}
                        </h1>
                        @if($slide->subtitle)
                            <p class="text-lg md:text-xl text-gray-200 mb-8 drop-shadow-md max-w-2xl">
                                {{ $slide->subtitle }}
                            </p>
                        @endif
                        @if($slide->cta_text)
                            <a href="{{ $slide->cta_link ?? '#' }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-primary text-white font-semibold rounded-full hover:bg-primary-dark transition-all hover:-translate-y-1 shadow-elevated text-lg">
                                {{ $slide->cta_text }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            {{-- Default Fallback Slide --}}
            <div class="absolute inset-0 z-10">
                <div class="absolute inset-0 bg-primary/90 flex items-center justify-center">
                    <div class="text-center px-4">
                        <h1 class="text-3xl md:text-5xl font-heading font-bold text-white mb-4">Selamat Datang di Panti Asuhan</h1>
                        <p class="text-lg text-white/90">Bersama membangun generasi mandiri dan berakhlak mulia.</p>
                    </div>
                </div>
            </div>
        @endforelse

        {{-- Controls --}}
        @if($slides->count() > 1)
            <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-sm flex items-center justify-center text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 rounded-full bg-white/20 hover:bg-white/40 backdrop-blur-sm flex items-center justify-center text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex gap-2">
                @foreach($slides as $index => $slide)
                    <button @click="goTo({{ $index }})" class="w-2.5 h-2.5 rounded-full transition-all duration-300" :class="{ 'bg-primary w-8': activeSlide === {{ $index }}, 'bg-white/50 hover:bg-white': activeSlide !== {{ $index }} }"></button>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- 2. Core Values & Intro --}}
<section class="py-16 md:py-24 bg-surface relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary font-medium text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    Tentang Kami
                </div>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-heading leading-tight">
                    Mengabdi untuk Kesejahteraan Anak Yatim & Dhuafa
                </h2>
                <div class="prose prose-sm md:prose-base text-text-light text-justify">
                    @if($aboutPage)
                        {!! Str::words(strip_tags($aboutPage->content), 40, '...') !!}
                    @else
                        Panti Asuhan kami hadir sebagai lembaga pengasuhan dan pendidikan yang berdedikasi tinggi untuk memberikan kehidupan yang lebih baik bagi anak-anak yatim, piatu, dan dhuafa.
                    @endif
                </div>
                <a href="{{ route('about') }}" class="inline-flex items-center gap-2 font-semibold text-primary hover:text-primary-dark transition-colors">
                    Baca Selengkapnya 
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Value Cards --}}
                <div class="bg-background rounded-2xl p-6 shadow-subtle border border-border hover:shadow-card transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center text-accent mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-lg text-heading mb-2">Pendidikan Baik</h3>
                    <p class="text-sm text-text-light">Memberikan akses pendidikan formal dan non-formal yang berkualitas.</p>
                </div>
                <div class="bg-background rounded-2xl p-6 shadow-subtle border border-border hover:shadow-card transition-shadow lg:translate-y-6">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-lg text-heading mb-2">Pembinaan Akhlak</h3>
                    <p class="text-sm text-text-light">Menanamkan nilai-nilai keislaman dan budi pekerti yang luhur.</p>
                </div>
                <div class="bg-background rounded-2xl p-6 shadow-subtle border border-border hover:shadow-card transition-shadow">
                    <div class="w-12 h-12 rounded-xl bg-info/10 flex items-center justify-center text-info mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-lg text-heading mb-2">Keterampilan</h3>
                    <p class="text-sm text-text-light">Membekali anak dengan life skill agar siap mandiri di masa depan.</p>
                </div>
                <div class="bg-background rounded-2xl p-6 shadow-subtle border border-border hover:shadow-card transition-shadow lg:translate-y-6">
                    <div class="w-12 h-12 rounded-xl bg-warning/10 flex items-center justify-center text-warning mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-heading font-semibold text-lg text-heading mb-2">Kasih Sayang</h3>
                    <p class="text-sm text-text-light">Lingkungan pengasuhan yang aman, nyaman, dan penuh kekeluargaan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 3. Berita & Artikel Terbaru --}}
@if($recentNews->count() > 0)
<section class="py-16 md:py-24 bg-background border-y border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-heading font-bold text-heading mb-4">Kabar Terbaru</h2>
                <p class="text-text-light">Ikuti terus perkembangan, kegiatan, dan cerita inspiratif dari anak-anak asuh dan pengurus panti.</p>
            </div>
            <a href="{{ route('news.index') }}" class="shrink-0 inline-flex items-center gap-2 px-6 py-2.5 bg-surface border border-border text-heading font-medium rounded-full hover:bg-border transition-colors">
                Lihat Semua Berita
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentNews as $news)
                <article class="bg-surface rounded-2xl overflow-hidden shadow-subtle border border-border hover:shadow-card transition-shadow group flex flex-col">
                    <a href="{{ route('news.show', $news->slug) }}" class="block aspect-video overflow-hidden relative bg-background">
                        @if($news->cover_image)
                            <img src="{{ $news->cover_image_url }}" alt="{{ $news->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
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
                                {{ $news->published_at->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <h3 class="font-heading font-bold text-xl text-heading mb-3 group-hover:text-primary transition-colors">
                            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                        </h3>
                        <p class="text-sm text-text-light line-clamp-3 mb-6 flex-grow">
                            {{ $news->excerpt ?: Str::words(strip_tags($news->content), 20) }}
                        </p>
                        <a href="{{ route('news.show', $news->slug) }}" class="inline-flex items-center gap-2 font-medium text-primary hover:text-primary-dark transition-colors mt-auto">
                            Baca Artikel
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 4. Galeri Terbaru --}}
@if($recentGalleries->count() > 0)
<section class="py-16 md:py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl font-heading font-bold text-heading mb-4">Galeri Kegiatan</h2>
            <p class="text-text-light">Momen-momen berharga dan dokumentasi aktivitas yang ada di lingkungan panti asuhan kami.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recentGalleries as $gallery)
                <a href="{{ route('gallery.show', $gallery->slug) }}" class="group block relative rounded-2xl overflow-hidden aspect-[4/3] bg-background">
                    @if($gallery->cover_image)
                        <img src="{{ $gallery->cover_image_url }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute inset-0 p-6 flex flex-col justify-end">
                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-medium rounded-full mb-3 self-start">
                            {{ $gallery->items_count }} Foto
                        </span>
                        <h3 class="font-heading font-bold text-xl text-white mb-1 group-hover:text-primary-100 transition-colors">
                            {{ $gallery->title }}
                        </h3>
                        <p class="text-sm text-white/80 line-clamp-2">
                            {{ $gallery->description }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
        
        <div class="text-center mt-10">
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white border border-border text-heading font-medium rounded-full hover:bg-background transition-colors shadow-subtle">
                Lihat Album Lainnya
            </a>
        </div>
    </div>
</section>
@endif
{{-- 5. Kotak Doa & Harapan --}}
@if(isset($prayers) && $prayers->count() > 0)
<section class="py-16 md:py-24 bg-green-800 relative overflow-hidden">
    {{-- Dekorasi latar belakang --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-10 left-10 w-40 h-40 bg-white/5 rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-60 h-60 bg-white/5 rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-white/3 rounded-full"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-white font-medium text-sm mb-4">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                Kotak Doa & Harapan
            </div>
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-white mb-4">Doa & Harapan dari Para Donatur</h2>
            <p class="text-white/70 max-w-2xl mx-auto">Setiap doa yang Anda sampaikan bersama donasi adalah cahaya harapan bagi anak-anak panti asuhan kami.</p>
        </div>

        {{-- Grid Doa --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($prayers as $prayer)
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-colors">
                    {{-- Ikon kutipan --}}
                    <svg class="w-8 h-8 text-white/30 mb-3" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    
                    {{-- Teks Doa --}}
                    <p class="text-white/90 text-sm leading-relaxed mb-4 italic">
                        "{{ Str::limit($prayer->prayer, 150) }}"
                    </p>
                    
                    {{-- Nama Donatur --}}
                    <div class="flex items-center gap-2 pt-3 border-t border-white/10">
                        <div class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center text-white text-xs font-bold">
                            {{ strtoupper(substr($prayer->display_name, 0, 1)) }}
                        </div>
                        <span class="text-white/70 text-sm font-medium">{{ $prayer->display_name }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- CTA Donatur --}}
        <div class="text-center mt-12">
            <p class="text-white/60 text-sm mb-4">Ingin donasi Anda tercatat di sistem dan mudah dilacak?</p>
            <a href="{{ route('donatur.register') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-white text-green-800 font-semibold rounded-full hover:bg-gray-100 transition-all hover:-translate-y-0.5 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                Daftar Akun Donatur
            </a>
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
{{-- Alpine.js for Carousel --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('heroCarousel', () => ({
            activeSlide: 0,
            slidesCount: {{ $slides->count() }},
            autoplayInterval: null,
            init() {
                if(this.slidesCount > 1) {
                    this.startAutoplay();
                }
            },
            next() {
                this.activeSlide = (this.activeSlide === this.slidesCount - 1) ? 0 : this.activeSlide + 1;
                this.resetAutoplay();
            },
            prev() {
                this.activeSlide = (this.activeSlide === 0) ? this.slidesCount - 1 : this.activeSlide - 1;
                this.resetAutoplay();
            },
            goTo(index) {
                this.activeSlide = index;
                this.resetAutoplay();
            },
            startAutoplay() {
                this.autoplayInterval = setInterval(() => {
                    this.activeSlide = (this.activeSlide === this.slidesCount - 1) ? 0 : this.activeSlide + 1;
                }, 5000); // 5 seconds
            },
            resetAutoplay() {
                clearInterval(this.autoplayInterval);
                this.startAutoplay();
            }
        }))
    })
</script>
@endpush
