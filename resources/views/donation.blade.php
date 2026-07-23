@extends('layouts.app')

@section('title', 'Informasi Donasi')
@section('meta_description', 'Salurkan donasi Anda untuk anak-anak yatim dan dhuafa di Panti Asuhan Muhammadiyah Semarang.')

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-4">Salurkan Donasi Anda</h1>
        <p class="text-text-light text-lg max-w-2xl mx-auto">Mari bersama-sama wujudkan kepedulian dan kebahagiaan untuk anak-anak yatim dan dhuafa. Setiap kebaikan Anda sangat berarti bagi mereka.</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 items-start">
        
        {{-- Bank Transfer --}}
        <div class="bg-surface rounded-2xl shadow-card border border-border p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-full -mr-10 -mt-10"></div>
            
            <div class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary mb-6 relative z-10">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            
            <h2 class="font-heading font-bold text-2xl text-heading mb-6 relative z-10">Transfer Bank</h2>
            
            <div class="space-y-6 relative z-10">
                <div>
                    <p class="text-sm text-text-light mb-1">Bank Tujuan</p>
                    <p class="font-bold text-lg text-heading">{{ $donationSettings['bank_name'] ?? 'Belum diatur' }}</p>
                </div>
                <div>
                    <p class="text-sm text-text-light mb-1">Nomor Rekening</p>
                    <div class="flex items-center gap-3">
                        <p class="font-mono text-2xl font-bold text-primary" id="bank-account">{{ $donationSettings['bank_account_number'] ?? 'Belum diatur' }}</p>
                        @if(!empty($donationSettings['bank_account_number']))
                            <button onclick="copyToClipboard('bank-account', this)" class="p-2 bg-background rounded-lg text-text-light hover:text-primary hover:bg-primary/10 transition-colors" title="Salin Nomor Rekening">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        @endif
                    </div>
                </div>
                <div>
                    <p class="text-sm text-text-light mb-1">Atas Nama</p>
                    <p class="font-semibold text-text">{{ $donationSettings['bank_account_name'] ?? 'Belum diatur' }}</p>
                </div>
            </div>
        </div>

        {{-- QRIS --}}
        <div class="bg-surface rounded-2xl shadow-card border border-border p-8 relative overflow-hidden flex flex-col h-full">
            <div class="absolute top-0 right-0 w-32 h-32 bg-accent/5 rounded-bl-full -mr-10 -mt-10"></div>
            
            <div class="w-14 h-14 rounded-full bg-accent/10 flex items-center justify-center text-accent mb-6 relative z-10">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
            </div>
            
            <h2 class="font-heading font-bold text-2xl text-heading mb-6 relative z-10">Scan QRIS</h2>
            
            <div class="flex-grow flex flex-col items-center justify-center text-center relative z-10">
                @if(!empty($donationSettings['qris_image']))
                    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mb-4 inline-block">
                        <img src="{{ asset('storage/' . $donationSettings['qris_image']) }}" alt="QRIS Code" class="w-48 sm:w-64 max-w-full h-auto">
                    </div>
                    <p class="text-sm text-text-light">Scan kode QR di atas menggunakan aplikasi m-banking atau e-wallet (GoPay, OVO, Dana, LinkAja, ShopeePay).</p>
                @else
                    <div class="w-48 h-48 bg-background border-2 border-dashed border-border rounded-xl flex items-center justify-center text-text-light mb-4">
                        Kode QRIS Belum Tersedia
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Confirmation Note --}}
    <div class="mt-12 bg-primary/10 rounded-2xl p-6 sm:p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left border border-primary/20">
        <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white shrink-0">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <h3 class="font-heading font-bold text-xl text-heading mb-2">Konfirmasi Donasi</h3>
            <p class="text-text-light mb-4">Setelah melakukan transfer, mohon kesediaannya untuk melakukan konfirmasi melalui WhatsApp agar kami dapat mencatat donasi Anda dengan baik dan mengirimkan doa tanda terima kasih.</p>
            @php
                $waNumber = \App\Models\SiteSetting::get('whatsapp_number');
                $waText = urlencode('Assalamu\'alaikum, saya ingin konfirmasi donasi ke Panti Asuhan Muhammadiyah Semarang.');
            @endphp
            @if($waNumber)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $waNumber) }}?text={{ $waText }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-2.5 bg-accent hover:bg-green-600 text-white font-semibold rounded-lg transition-colors shadow-subtle">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Konfirmasi via WhatsApp
                </a>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function copyToClipboard(elementId, btnElement) {
        const text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(() => {
            const originalHTML = btnElement.innerHTML;
            // Tampilkan icon checklist hijau
            btnElement.innerHTML = '<svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
            setTimeout(() => {
                btnElement.innerHTML = originalHTML;
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy text: ', err);
        });
    }
</script>
@endpush
