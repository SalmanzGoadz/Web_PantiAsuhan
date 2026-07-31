{{-- Dashboard Donatur --}}
{{-- Menampilkan ringkasan statistik donasi & riwayat donasi --}}
@extends('donatur.layouts.app')

@section('title', 'Dashboard Donatur')

@section('content')

{{-- Header Selamat Datang --}}
<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-heading font-bold text-gray-800 mb-1" style="font-family: 'El Messiri', serif;">
        Assalamu'alaikum, {{ Auth::user()->name }}! 👋
    </h1>
    <p class="text-sm text-gray-500">Berikut adalah ringkasan dan riwayat donasi Anda.</p>
</div>

{{-- Statistik Ringkasan --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    {{-- Total Donasi --}}
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Donasi</p>
                <p class="text-xl font-bold text-gray-800 mt-1.5">Rp {{ number_format($stats['total_donasi'], 0, ',', '.') }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-[#009c48]/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#009c48]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    {{-- Tervalidasi --}}
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Tervalidasi</p>
                <p class="text-xl font-bold text-[#009c48] mt-1.5">Rp {{ number_format($stats['total_tervalidasi'], 0, ',', '.') }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-[#009c48]/10 flex items-center justify-center">
                <svg class="w-5 h-5 text-[#009c48]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>

    {{-- Jumlah Donasi --}}
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Jumlah Donasi</p>
                <p class="text-xl font-bold text-gray-800 mt-1.5">{{ $stats['jumlah_donasi'] }}x</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>
    </div>

    {{-- Menunggu Validasi --}}
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menunggu Validasi</p>
                <p class="text-xl font-bold text-yellow-600 mt-1.5">{{ $stats['menunggu_count'] }}</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-yellow-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

{{-- Tombol Kirim Donasi --}}
<div class="mb-6">
    <a href="{{ route('donatur.donation.create') }}"
       class="inline-flex items-center gap-2 bg-[#ff6b00] hover:opacity-90 text-white font-bold rounded-lg px-6 py-3 shadow-md transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Kirim Donasi Baru
    </a>
</div>

{{-- Tabel Riwayat Donasi --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="font-heading font-semibold text-gray-800 text-lg">Riwayat Donasi Anda</h2>
    </div>

    @if($donations->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50">
                        <th class="text-left px-4 py-3 font-semibold text-gray-400 text-xs uppercase tracking-wider">#</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-400 text-xs uppercase tracking-wider">Tanggal</th>
                        <th class="text-right px-4 py-3 font-semibold text-gray-400 text-xs uppercase tracking-wider">Jumlah</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-400 text-xs uppercase tracking-wider">Bukti</th>
                        <th class="text-center px-4 py-3 font-semibold text-gray-400 text-xs uppercase tracking-wider">Status</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-400 text-xs uppercase tracking-wider">Doa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($donations as $index => $donation)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-3 text-gray-400">{{ $donations->firstItem() + $index }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $donation->date->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-gray-800">Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($donation->proof_image_url)
                                    <a href="{{ $donation->proof_image_url }}" target="_blank"
                                       class="inline-flex items-center gap-1 text-[#009c48] hover:text-green-700 text-xs font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($donation->isTervalidasi())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Tervalidasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                        Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-400 text-xs max-w-[200px] truncate">
                                {{ $donation->prayer ?? '—' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        @if($donations->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $donations->links() }}
            </div>
        @endif
    @else
        <div class="px-6 py-12 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
            <p class="text-gray-400 mb-4">Anda belum memiliki riwayat donasi.</p>
            <a href="{{ route('donatur.donation.create') }}"
               class="inline-flex items-center gap-2 bg-[#ff6b00] hover:opacity-90 text-white text-sm font-bold rounded-lg px-5 py-2.5 shadow-md transition-all">
                Kirim Donasi Pertama
            </a>
        </div>
    @endif
</div>

@endsection
