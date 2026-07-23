@extends('layouts.app')

@section('title', $aboutPage ? $aboutPage->meta_title ?: $aboutPage->title : 'Tentang Kami')
@section('meta_description', $aboutPage ? $aboutPage->meta_description : '')

@section('content')

{{-- Page Header --}}
<div class="bg-primary pt-24 pb-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 mix-blend-overlay"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-heading font-bold text-white mb-4">Tentang Kami</h1>
        <p class="text-white/80 text-lg max-w-2xl mx-auto">Profil singkat, visi, dan misi Panti Asuhan Muhammadiyah Kota Semarang.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16">
        
        {{-- Sidebar Navigation --}}
        <div class="lg:col-span-4">
            <div class="sticky top-28 bg-surface rounded-2xl shadow-subtle border border-border p-6">
                <h3 class="font-heading font-bold text-lg text-heading mb-4 pb-4 border-b border-border">Profil Organisasi</h3>
                <nav class="space-y-2">
                    <a href="#sejarah" class="flex items-center gap-3 w-full px-4 py-3 bg-primary/10 text-primary font-medium rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Sejarah Singkat
                    </a>
                    <a href="#visi-misi" class="flex items-center gap-3 w-full px-4 py-3 text-text hover:bg-background hover:text-primary font-medium rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Visi & Misi
                    </a>
                    <a href="{{ route('organization') }}" class="flex items-center gap-3 w-full px-4 py-3 text-text hover:bg-background hover:text-primary font-medium rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Struktur Pengurus
                    </a>
                </nav>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="lg:col-span-8 space-y-16">
            
            {{-- Sejarah Section --}}
            <section id="sejarah" class="scroll-mt-32">
                <div class="prose prose-lg max-w-none text-text-light prose-headings:font-heading prose-headings:font-bold prose-headings:text-heading prose-a:text-primary prose-a:no-underline hover:prose-a:underline">
                    @if($aboutPage)
                        {!! $aboutPage->content !!}
                    @else
                        <h2>Sejarah Panti Asuhan</h2>
                        <p>Konten sejarah belum tersedia. Silakan tambahkan melalui panel admin.</p>
                    @endif
                </div>
            </section>

            <hr class="border-border">

            {{-- Visi Misi Section --}}
            <section id="visi-misi" class="scroll-mt-32">
                <div class="prose prose-lg max-w-none text-text-light prose-headings:font-heading prose-headings:font-bold prose-headings:text-heading prose-ul:list-none prose-ul:pl-0 prose-li:pl-8 prose-li:relative">
                    @if($visiMisiPage)
                        {!! str_replace('<li>', '<li class="relative before:absolute before:left-0 before:top-2 before:w-5 before:h-5 before:bg-[url(\'data:image/svg+xml;utf8,<svg fill=%22none%22 stroke=%22%23ff6b00%22 viewBox=%220 0 24 24%22 xmlns=%22http://www.w3.org/2000/svg%22><path stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M5 13l4 4L19 7%22></path></svg>\')] before:bg-no-repeat before:bg-contain">', $visiMisiPage->content) !!}
                    @else
                        <h2>Visi & Misi</h2>
                        <p>Konten visi misi belum tersedia. Silakan tambahkan melalui panel admin.</p>
                    @endif
                </div>
            </section>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Simple smooth scrolling for sidebar links
    document.querySelectorAll('nav a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Update active state
            document.querySelectorAll('nav a').forEach(a => {
                a.classList.remove('bg-primary/10', 'text-primary');
                a.classList.add('text-text', 'hover:bg-background');
            });
            this.classList.remove('text-text', 'hover:bg-background');
            this.classList.add('bg-primary/10', 'text-primary');

            // Scroll
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endpush
