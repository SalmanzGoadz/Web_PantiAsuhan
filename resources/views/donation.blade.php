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

    {{-- CTA Pendaftaran Donatur --}}
    @guest
    <div class="mt-8 bg-green-800/5 rounded-2xl p-6 sm:p-8 border border-green-800/10">
        <div class="flex flex-col sm:flex-row items-center gap-6 text-center sm:text-left">
            <div class="w-14 h-14 rounded-full bg-green-800/10 flex items-center justify-center text-green-800 shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <div class="flex-1">
                <h3 class="font-heading font-bold text-lg text-green-900 mb-2">Ingin donasi Anda tercatat di sistem dan mudah dilacak?</h3>
                <p class="text-text-light text-sm mb-4">Dengan mendaftar sebagai Donatur, Anda bisa mengirim donasi langsung melalui website, mengunggah bukti transfer, menulis doa, dan melihat riwayat donasi Anda secara real-time.</p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('donatur.register') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-green-800 text-white font-semibold rounded-lg hover:bg-green-900 transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Daftar Akun Donatur
                    </a>
                    <a href="{{ route('donatur.login') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 border border-green-800/30 text-green-800 font-semibold rounded-lg hover:bg-green-800/5 transition-colors">
                        Sudah punya akun? Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endguest
</div>

{{-- ============================================================ --}}
{{-- TRANSPARANSI KEUANGAN / BUKU KAS --}}
{{-- ============================================================ --}}
<div class="bg-surface border-t border-border">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">

        {{-- Section Title --}}
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-heading font-bold text-heading mb-3">Transparansi Keuangan</h2>
            <p class="text-text-light max-w-2xl mx-auto">Kami berkomitmen untuk transparan dalam pengelolaan dana. Berikut adalah laporan keuangan terkini dari setiap donasi yang masuk dan pengeluaran yang dilakukan.</p>
        </div>

        {{-- Financial Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
            {{-- Total Donasi --}}
            <div class="bg-background rounded-2xl p-6 text-center border border-border">
                <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center text-accent mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-sm text-text-light mb-1">Total Donasi Masuk</p>
                <p class="text-xl font-bold text-heading">Rp {{ number_format($totalDonors, 0, ',', '.') }}</p>
            </div>

            {{-- Total Pengeluaran --}}
            <div class="bg-background rounded-2xl p-6 text-center border border-border">
                <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center text-danger mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <p class="text-sm text-text-light mb-1">Total Pengeluaran</p>
                <p class="text-xl font-bold text-heading">Rp {{ number_format($totalExpensesTerlaksana, 0, ',', '.') }}</p>
            </div>

            {{-- Saldo Tersedia --}}
            <div class="bg-accent/5 rounded-2xl p-6 text-center border-2 border-accent/20">
                <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center text-accent mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-sm text-text-light mb-1">Total Dana Tersedia</p>
                <p class="text-2xl font-bold text-accent">Rp {{ number_format($totalBalance, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Recent Donors --}}
            <div>
                <h3 class="font-heading font-bold text-lg text-heading mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Donatur Terbaru
                </h3>

                @if($recentDonors->isNotEmpty())
                    <div class="bg-background rounded-xl border border-border overflow-hidden">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-border">
                                    <th class="text-left px-4 py-3 font-semibold text-text-light">Nama</th>
                                    <th class="text-right px-4 py-3 font-semibold text-text-light">Jumlah</th>
                                    <th class="text-right px-4 py-3 font-semibold text-text-light">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border">
                                @foreach($recentDonors as $donor)
                                    <tr class="hover:bg-surface/50 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-full bg-accent/10 flex items-center justify-center text-accent text-xs font-bold shrink-0">
                                                    {{ strtoupper(substr($donor->display_name, 0, 1)) }}
                                                </div>
                                                <span class="font-medium text-heading">{{ $donor->display_name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-right font-semibold text-accent">Rp {{ number_format($donor->amount, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-right text-text-light text-xs">{{ $donor->date->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-background rounded-xl border border-border p-8 text-center text-text-light">
                        <p>Belum ada data donatur.</p>
                    </div>
                @endif
            </div>

            {{-- Expenses / RAB --}}
            <div>
                <h3 class="font-heading font-bold text-lg text-heading mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Rencana Anggaran Belanja (RAB)
                </h3>

                @if($expenses->isNotEmpty())
                    <div class="bg-background rounded-xl border border-border overflow-hidden">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-border">
                                    <th class="text-left px-4 py-3 font-semibold text-text-light">Kegiatan</th>
                                    <th class="text-right px-4 py-3 font-semibold text-text-light">Jumlah</th>
                                    <th class="text-center px-4 py-3 font-semibold text-text-light">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border">
                                @foreach($expenses as $expense)
                                    <tr class="hover:bg-surface/50 transition-colors">
                                        <td class="px-4 py-3">
                                            <p class="font-medium text-heading">{{ $expense->title }}</p>
                                            <p class="text-xs text-text-light">{{ $expense->date->format('d M Y') }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-right font-semibold text-text">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @if($expense->isTerlaksana())
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                    Terlaksana
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                                    Rencana
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-background rounded-xl border border-border p-8 text-center text-text-light">
                        <p>Belum ada data pengeluaran.</p>
                    </div>
                @endif
            </div>
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
