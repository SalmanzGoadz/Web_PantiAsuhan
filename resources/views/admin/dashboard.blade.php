@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Berita --}}
        <div class="bg-surface rounded-xl shadow-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Total Berita</p>
                    <p class="text-2xl font-bold text-heading mt-1">{{ $stats['total_news'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-3 text-xs">
                <span class="text-accent font-medium">{{ $stats['published_news'] }} Published</span>
                <span class="text-text-light">{{ $stats['draft_news'] }} Draft</span>
            </div>
        </div>

        {{-- Total Galeri --}}
        <div class="bg-surface rounded-xl shadow-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Album Galeri</p>
                    <p class="text-2xl font-bold text-heading mt-1">{{ $stats['total_galleries'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                </div>
            </div>
        </div>

        {{-- Anggota Organisasi --}}
        <div class="bg-surface rounded-xl shadow-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Pengurus Aktif</p>
                    <p class="text-2xl font-bold text-heading mt-1">{{ $stats['total_members'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
        </div>

        {{-- Saldo Keuangan --}}
        <div class="bg-surface rounded-xl shadow-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Saldo Keuangan</p>
                    <p class="text-2xl font-bold {{ $stats['total_balance'] >= 0 ? 'text-accent' : 'text-danger' }} mt-1">Rp {{ number_format($stats['total_balance'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl {{ $stats['total_balance'] >= 0 ? 'bg-accent/10' : 'bg-red-50' }} flex items-center justify-center">
                    <svg class="w-6 h-6 {{ $stats['total_balance'] >= 0 ? 'text-accent' : 'text-danger' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-3 text-xs">
                <span class="text-accent font-medium">{{ $stats['donor_count'] }} donatur</span>
                <a href="{{ route('admin.buku-kas.index') }}" class="text-primary hover:underline">Lihat Buku Kas →</a>
            </div>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-surface rounded-xl shadow-card">
        <div class="px-6 py-4 border-b border-border">
            <h2 class="font-heading font-semibold text-heading">Aktivitas Terakhir</h2>
        </div>
        <div class="divide-y divide-border">
            @forelse($recentActivities as $activity)
                <div class="px-6 py-3 flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-background flex items-center justify-center shrink-0">
                        @if($activity->action === 'created')
                            <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        @elseif($activity->action === 'updated')
                            <svg class="w-4 h-4 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        @elseif($activity->action === 'deleted')
                            <svg class="w-4 h-4 text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        @else
                            <svg class="w-4 h-4 text-text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-text truncate">{{ $activity->description ?? $activity->action }}</p>
                        <p class="text-xs text-text-light mt-0.5">
                            {{ $activity->user?->name ?? 'System' }} · {{ $activity->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-text-light">
                    Belum ada aktivitas tercatat.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
