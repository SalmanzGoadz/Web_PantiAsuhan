<footer class="bg-surface border-t border-border mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
            
            {{-- Column 1: Identity & Social --}}
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    @if($logoPrimary = \App\Models\SiteSetting::get('logo_primary'))
                        <img src="{{ asset('storage/' . $logoPrimary) }}" alt="Logo" class="h-12 w-auto object-contain">
                    @else
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                    @endif
                    <div>
                        <span class="block font-heading font-bold text-heading text-lg leading-tight">{{ \App\Models\SiteSetting::get('site_name', 'Panti Asuhan') }}</span>
                    </div>
                </div>
                <p class="text-sm text-text-light leading-relaxed">
                    {{ \App\Models\SiteSetting::get('site_description', 'Lembaga kesejahteraan sosial yang peduli pada pembinaan dan pendidikan anak asuh.') }}
                </p>
                <div class="flex items-center gap-4">
                    @if($fb = \App\Models\SiteSetting::get('facebook'))
                        <a href="{{ $fb }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-background flex items-center justify-center text-text hover:text-white hover:bg-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.312h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                    @endif
                    @if($ig = \App\Models\SiteSetting::get('instagram'))
                        <a href="{{ $ig }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-background flex items-center justify-center text-text hover:text-white hover:bg-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    @endif
                    @if($yt = \App\Models\SiteSetting::get('youtube'))
                        <a href="{{ $yt }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-background flex items-center justify-center text-text hover:text-white hover:bg-primary transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Column 2: Tautan Cepat --}}
            <div>
                <h3 class="font-heading font-semibold text-heading text-lg mb-6 relative inline-block">
                    Tautan Cepat
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-primary rounded-full"></span>
                </h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-sm text-text-light hover:text-primary transition-colors inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Tentang Kami</a></li>
                    <li><a href="{{ route('organization') }}" class="text-sm text-text-light hover:text-primary transition-colors inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Struktur Pengurus</a></li>
                    <li><a href="{{ route('sop') }}" class="text-sm text-text-light hover:text-primary transition-colors inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> SOP Pengasuhan</a></li>
                    <li><a href="{{ route('news.index') }}" class="text-sm text-text-light hover:text-primary transition-colors inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Berita & Artikel</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="text-sm text-text-light hover:text-primary transition-colors inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Galeri Kegiatan</a></li>
                    <li><a href="{{ route('donation') }}" class="text-sm text-text-light hover:text-primary transition-colors inline-flex items-center gap-2"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg> Informasi Donasi</a></li>
                </ul>
            </div>

            {{-- Column 3: Hubungi Kami --}}
            <div>
                <h3 class="font-heading font-semibold text-heading text-lg mb-6 relative inline-block">
                    Hubungi Kami
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-primary rounded-full"></span>
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm text-text-light leading-relaxed">{{ \App\Models\SiteSetting::get('address', 'Alamat Panti') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:{{ \App\Models\SiteSetting::get('phone') }}" class="text-sm text-text-light hover:text-primary transition-colors">{{ \App\Models\SiteSetting::get('phone', '-') }}</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:{{ \App\Models\SiteSetting::get('email') }}" class="text-sm text-text-light hover:text-primary transition-colors">{{ \App\Models\SiteSetting::get('email', '-') }}</a>
                    </li>
                </ul>
            </div>

            {{-- Column 4: Maps --}}
            <div class="h-full">
                <h3 class="font-heading font-semibold text-heading text-lg mb-6 relative inline-block">
                    Peta Lokasi
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-primary rounded-full"></span>
                </h3>
                <div class="w-full h-48 bg-background rounded-xl overflow-hidden border border-border">
                    @if($map = \App\Models\SiteSetting::get('google_maps_embed'))
                        <iframe src="{{ $map }}" class="w-full h-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <div class="w-full h-full flex items-center justify-center text-text-light text-sm">Peta belum diatur</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    
    {{-- Copyright Bar --}}
    <div class="bg-background border-t border-border py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-sm text-text-light text-center md:text-left">
                &copy; {{ date('Y') }} {{ \App\Models\SiteSetting::get('site_name', 'Panti Asuhan') }}. Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-4 text-sm text-text-light">
                <a href="{{ route('admin.login') }}" class="hover:text-primary transition-colors">Admin Login</a>
            </div>
        </div>
    </div>
</footer>
