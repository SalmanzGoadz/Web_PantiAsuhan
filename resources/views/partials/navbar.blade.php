<nav class="bg-surface sticky top-0 z-50 shadow-subtle border-b border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            {{-- Logo Section --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if($logoPrimary = \App\Models\SiteSetting::get('logo_primary'))
                        <img src="{{ asset('storage/' . $logoPrimary) }}" alt="Logo 1" class="h-10 sm:h-12 w-auto object-contain">
                    @else
                        {{-- Fallback Icon --}}
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    @endif

                    
                    
                    <div class="hidden lg:block ml-2">
                        <span class="block font-heading font-bold text-heading text-lg leading-tight">{{ \App\Models\SiteSetting::get('site_name', 'Panti Asuhan') }}</span>
                    </div>

                    @if($logoSecondary = \App\Models\SiteSetting::get('logo_secondary'))
                        <img src="{{ asset('storage/' . $logoSecondary) }}" alt="Logo 2" class="h-10 sm:h-12 w-auto object-contain hidden sm:block">
                    @endif
                    
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden desktop:flex desktop:items-center desktop:gap-6">
                <a href="{{ route('home') }}" class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('home') ? 'text-primary' : 'text-text' }}">Beranda</a>
                
                {{-- Dropdown Profil --}}
                <div class="relative group">
                    <button class="flex items-center gap-1 text-sm font-medium text-text hover:text-primary transition-colors py-2">
                        Profil <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-surface rounded-xl shadow-card border border-border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform translate-y-2 group-hover:translate-y-0">
                        <div class="py-2">
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-text hover:bg-primary/5 hover:text-primary">Tentang Kami</a>
                            <a href="{{ route('organization') }}" class="block px-4 py-2 text-sm text-text hover:bg-primary/5 hover:text-primary">Pengurus</a>
                            <a href="{{ route('sop') }}" class="block px-4 py-2 text-sm text-text hover:bg-primary/5 hover:text-primary">SOP Pengasuhan</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('news.index') }}" class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('news.*') ? 'text-primary' : 'text-text' }}">Berita</a>
                <a href="{{ route('gallery.index') }}" class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('gallery.*') ? 'text-primary' : 'text-text' }}">Galeri</a>
                <a href="{{ route('contact') }}" class="text-sm font-medium transition-colors hover:text-primary {{ request()->routeIs('contact') ? 'text-primary' : 'text-text' }}">Kontak</a>

                {{-- Right Side: CTA + Auth --}}
                <div class="flex items-center gap-x-6 ml-4">
                    <a href="{{ route('donation') }}" class="bg-[#ff6b00] text-white px-5 py-2 rounded-lg text-[13px] font-bold hover:opacity-90 transition-all shrink-0 shadow-sm">
                        Donasi Sekarang
                    </a>

                    @auth
                        <div class="flex items-center gap-x-4">
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-[13px] font-bold text-gray-700 hover:text-[#009c48] transition-colors">
                                    Admin Panel
                                </a>
                            @else
                                <a href="{{ route('donatur.dashboard') }}" class="text-[13px] font-bold text-gray-700 hover:text-[#009c48] transition-colors">
                                    Dashboard Saya
                                </a>
                            @endif
                            <div class="h-4 w-[1px] bg-gray-300"></div>
                            <form method="POST" action="{{ Auth::user()->isAdmin() ? route('admin.logout') : route('donatur.logout') }}">
                                @csrf
                                <button type="submit" class="text-[13px] font-bold text-gray-400 hover:text-red-500 transition-colors">Keluar</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('donatur.login') }}" class="text-[13px] font-bold text-gray-700 hover:text-[#009c48] transition-colors">Masuk</a>
                    @endauth
                </div>
            </div>

            {{-- Mobile Menu Button --}}
            <div class="flex items-center desktop:hidden">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-text hover:text-primary hover:bg-primary/5 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary transition-colors" aria-expanded="false">
                    <span class="sr-only">Buka menu utama</span>
                    {{-- Icon Menu --}}
                    <svg class="block w-6 h-6" id="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    {{-- Icon Close --}}
                    <svg class="hidden w-6 h-6" id="close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="hidden desktop:hidden" id="mobile-menu">
        <div class="px-4 pt-2 pb-6 space-y-1 bg-surface border-t border-border shadow-elevated">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('home') ? 'bg-primary/10 text-primary' : 'text-text hover:bg-background' }}">Beranda</a>
            
            <div class="py-2">
                <p class="px-3 text-xs font-semibold text-text-light uppercase tracking-wider mb-1">Profil Panti</p>
                <a href="{{ route('about') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('about') ? 'bg-primary/10 text-primary' : 'text-text hover:bg-background' }}">Tentang Kami</a>
                <a href="{{ route('organization') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('organization') ? 'bg-primary/10 text-primary' : 'text-text hover:bg-background' }}">Pengurus</a>
                <a href="{{ route('sop') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('sop') ? 'bg-primary/10 text-primary' : 'text-text hover:bg-background' }}">SOP Pengasuhan</a>
            </div>

            <a href="{{ route('news.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('news.*') ? 'bg-primary/10 text-primary' : 'text-text hover:bg-background' }}">Berita</a>
            <a href="{{ route('gallery.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('gallery.*') ? 'bg-primary/10 text-primary' : 'text-text hover:bg-background' }}">Galeri</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2.5 rounded-lg text-base font-medium {{ request()->routeIs('contact') ? 'bg-primary/10 text-primary' : 'text-text hover:bg-background' }}">Kontak</a>
            
            <div class="pt-4 pb-2 space-y-2">
                <a href="{{ route('donation') }}" class="block w-full text-center px-4 py-3 bg-primary text-white font-semibold text-base rounded-xl hover:bg-primary-dark transition-colors shadow-subtle">
                    Donasi Sekarang
                </a>

                {{-- Tombol Masuk/Daftar (Mobile) --}}
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block w-full text-center px-4 py-3 bg-accent text-white font-semibold text-base rounded-xl hover:bg-green-700 transition-colors">
                            Admin Panel
                        </a>
                    @else
                        <a href="{{ route('donatur.dashboard') }}" class="block w-full text-center px-4 py-3 bg-green-800 text-white font-semibold text-base rounded-xl hover:bg-green-900 transition-colors">
                            Dashboard Saya
                        </a>
                    @endif
                    <form method="POST" action="{{ Auth::user()->isAdmin() ? route('admin.logout') : route('donatur.logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-center px-4 py-3 text-red-600 font-medium text-base rounded-xl border border-red-200 hover:bg-red-50 transition-colors">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('donatur.login') }}" class="block w-full text-center px-4 py-3 border border-border text-heading font-semibold text-base rounded-xl hover:bg-background transition-colors">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const iconMenu = document.getElementById('menu-icon');
        const iconClose = document.getElementById('close-icon');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            iconMenu.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    });
</script>
@endpush
