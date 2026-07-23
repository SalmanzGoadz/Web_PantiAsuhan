@extends('layouts.app')

@section('title', 'Kontak Kami')
@section('meta_description', 'Hubungi Panti Asuhan Muhammadiyah Semarang melalui WhatsApp, Email, atau kunjungi lokasi kami secara langsung.')

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-4">Hubungi Kami</h1>
        <p class="text-text-light text-lg">Kami sangat senang mendengar dari Anda. Silakan hubungi kami untuk informasi lebih lanjut mengenai panti asuhan, program, atau donasi.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
        
        {{-- Contact Info Cards --}}
        <div class="grid gap-6">
            {{-- Alamat --}}
            <div class="bg-surface rounded-2xl shadow-subtle border border-border p-6 flex gap-4 hover:shadow-card transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-heading font-semibold text-lg text-heading mb-2">Alamat Lengkap</h3>
                    <p class="text-text-light leading-relaxed">{{ $contactSettings['address'] ?? 'Belum diatur' }}</p>
                </div>
            </div>

            {{-- Telepon & WhatsApp --}}
            <div class="bg-surface rounded-2xl shadow-subtle border border-border p-6 flex gap-4 hover:shadow-card transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center text-accent shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <h3 class="font-heading font-semibold text-lg text-heading mb-2">Telepon & WhatsApp</h3>
                    <div class="space-y-1">
                        @if(!empty($contactSettings['phone']))
                            <p class="text-text-light"><span class="font-medium">Telepon:</span> <a href="tel:{{ $contactSettings['phone'] }}" class="hover:text-primary transition-colors">{{ $contactSettings['phone'] }}</a></p>
                        @endif
                        @if(!empty($contactSettings['whatsapp_number']))
                            @php
                                $waUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $contactSettings['whatsapp_number']);
                            @endphp
                            <p class="text-text-light"><span class="font-medium">WhatsApp:</span> <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="text-accent hover:text-green-600 transition-colors">{{ $contactSettings['whatsapp_number'] }}</a></p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="bg-surface rounded-2xl shadow-subtle border border-border p-6 flex gap-4 hover:shadow-card transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-info/10 flex items-center justify-center text-info shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-heading font-semibold text-lg text-heading mb-2">Email</h3>
                    <p class="text-text-light">
                        <a href="mailto:{{ $contactSettings['email'] ?? '' }}" class="hover:text-primary transition-colors">{{ $contactSettings['email'] ?? 'Belum diatur' }}</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Google Maps Embed --}}
        <div class="bg-surface rounded-2xl shadow-card border border-border p-2 h-full min-h-[400px]">
            @if(!empty($contactSettings['google_maps_embed']))
                <iframe src="{{ $contactSettings['google_maps_embed'] }}" class="w-full h-full rounded-xl border-0 min-h-[400px]" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            @else
                <div class="w-full h-full rounded-xl bg-background flex items-center justify-center text-text-light min-h-[400px]">
                    <div class="text-center">
                        <svg class="w-12 h-12 mx-auto mb-3 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p>Peta lokasi belum diatur.</p>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
