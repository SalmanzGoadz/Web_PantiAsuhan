@extends('admin.layouts.app')

@section('title', 'Buku Kas')
@section('page-title', 'Buku Kas — Transparansi Keuangan')

@section('content')
<div class="space-y-6">

    {{-- Financial Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Donasi Masuk --}}
        <div class="bg-surface rounded-xl shadow-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Total Donasi Masuk</p>
                    <p class="text-xl font-bold text-heading mt-1">Rp {{ number_format($stats['total_donors'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="mt-2 text-xs text-text-light">{{ $stats['donor_count'] }} donatur tercatat</p>
        </div>

        {{-- Pengeluaran Terlaksana --}}
        <div class="bg-surface rounded-xl shadow-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Pengeluaran Terlaksana</p>
                    <p class="text-xl font-bold text-heading mt-1">Rp {{ number_format($stats['total_expenses_terlaksana'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
            <p class="mt-2 text-xs text-text-light">Dari {{ $stats['expense_count'] }} total pengeluaran</p>
        </div>

        {{-- Rencana Pengeluaran --}}
        <div class="bg-surface rounded-xl shadow-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Rencana Pengeluaran</p>
                    <p class="text-xl font-bold text-heading mt-1">Rp {{ number_format($stats['total_expenses_rencana'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                </div>
            </div>
            <p class="mt-2 text-xs text-text-light">Belum terlaksana</p>
        </div>

        {{-- Saldo Tersedia --}}
        <div class="bg-surface rounded-xl shadow-card p-5 border-2 {{ $stats['total_balance'] >= 0 ? 'border-accent/30' : 'border-danger/30' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-text-light">Saldo Dana Tersedia</p>
                    <p class="text-xl font-bold {{ $stats['total_balance'] >= 0 ? 'text-accent' : 'text-danger' }} mt-1">Rp {{ number_format($stats['total_balance'], 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl {{ $stats['total_balance'] >= 0 ? 'bg-accent/10' : 'bg-red-50' }} flex items-center justify-center">
                    <svg class="w-6 h-6 {{ $stats['total_balance'] >= 0 ? 'text-accent' : 'text-danger' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <p class="mt-2 text-xs text-text-light">Donasi − Pengeluaran Terlaksana</p>
        </div>
    </div>

    {{-- Tab Navigation --}}
    <div class="border-b border-border">
        <nav class="flex gap-4 -mb-px">
            <button onclick="switchTab('donors')" id="tab-btn-donors" class="px-1 pb-3 text-sm font-medium border-b-2 transition-fast border-primary text-primary">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Donatur
            </button>
            <button onclick="switchTab('expenses')" id="tab-btn-expenses" class="px-1 pb-3 text-sm font-medium border-b-2 transition-fast border-transparent text-text-light hover:text-text hover:border-border">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                RAB / Pengeluaran
            </button>
        </nav>
    </div>

        {{-- ============================================================ --}}
        {{-- DONORS TAB --}}
        {{-- ============================================================ --}}
        <div id="tab-donors" class="pt-6 space-y-6">

            {{-- Add Donor Form --}}
            <div class="bg-surface rounded-xl shadow-card p-6">
                <h3 class="font-heading font-semibold text-heading mb-4">Tambah Donatur Baru</h3>
                <form method="POST" action="{{ route('admin.buku-kas.donors.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="donor_name" class="block text-sm font-medium text-text mb-1.5">Nama Donatur <span class="text-danger">*</span></label>
                            <input type="text" id="donor_name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                   placeholder="Nama lengkap">
                        </div>
                        <div>
                            <label for="donor_amount" class="block text-sm font-medium text-text mb-1.5">Jumlah (Rp) <span class="text-danger">*</span></label>
                            <input type="number" id="donor_amount" name="amount" value="{{ old('amount') }}" required min="1"
                                   class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                   placeholder="100000">
                        </div>
                        <div>
                            <label for="donor_date" class="block text-sm font-medium text-text mb-1.5">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" id="donor_date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                                   class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        </div>
                        <div class="flex flex-col justify-end gap-3">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }}
                                       class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30">
                                <span class="text-sm text-text">Anonim (Hamba Allah)</span>
                            </label>
                            <button type="submit" class="px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
                                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Donors Search --}}
            <div class="bg-surface rounded-xl shadow-card p-4">
                <form method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input type="hidden" name="tab" value="donors">
                    <input type="text" name="donor_search" value="{{ request('donor_search') }}" placeholder="Cari nama donatur..."
                           class="flex-1 px-4 py-2 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <button type="submit" class="px-4 py-2 bg-background text-text text-sm font-medium rounded-lg hover:bg-border transition-fast">Filter</button>
                </form>
            </div>

            {{-- Donors Table --}}
            <div class="bg-surface rounded-xl shadow-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-background">
                            <tr>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">#</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Nama</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Jumlah</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Tanggal</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Status</th>
                                <th class="text-right px-6 py-3 font-semibold text-text-light">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @forelse($donors as $donor)
                                <tr class="hover:bg-background/50 transition-fast" id="donor-row-{{ $donor->id }}">
                                    <td class="px-6 py-4 text-text-light">{{ $loop->iteration + ($donors->currentPage() - 1) * $donors->perPage() }}</td>
                                    <td class="px-6 py-4 font-medium text-heading">{{ $donor->name }}</td>
                                    <td class="px-6 py-4 font-semibold text-accent">Rp {{ number_format($donor->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-text-light">{{ $donor->date->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($donor->is_anonymous)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Anonim</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Publik</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- Edit Button --}}
                                            <button onclick="openEditDonorModal({{ $donor->id }}, '{{ addslashes($donor->name) }}', {{ $donor->amount }}, '{{ $donor->date->format('Y-m-d') }}', {{ $donor->is_anonymous ? 'true' : 'false' }})"
                                                    class="p-2 rounded-lg text-text-light hover:text-info hover:bg-blue-50 transition-fast" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </button>
                                            {{-- Delete --}}
                                            <form method="POST" action="{{ route('admin.buku-kas.donors.destroy', $donor) }}" onsubmit="return confirm('Yakin ingin menghapus data donatur ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg text-text-light hover:text-danger hover:bg-red-50 transition-fast" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-text-light">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <p>Belum ada data donatur.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($donors->hasPages())
                    <div class="px-6 py-4 border-t border-border">
                        {{ $donors->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- EXPENSES TAB --}}
        {{-- ============================================================ --}}
        <div id="tab-expenses" class="pt-6 space-y-6" style="display: none;">

            {{-- Add Expense Form --}}
            <div class="bg-surface rounded-xl shadow-card p-6">
                <h3 class="font-heading font-semibold text-heading mb-4">Tambah Pengeluaran / RAB</h3>
                <form method="POST" action="{{ route('admin.buku-kas.expenses.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label for="expense_title" class="block text-sm font-medium text-text mb-1.5">Judul <span class="text-danger">*</span></label>
                            <input type="text" id="expense_title" name="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                   placeholder="Judul pengeluaran">
                        </div>
                        <div>
                            <label for="expense_amount" class="block text-sm font-medium text-text mb-1.5">Jumlah (Rp) <span class="text-danger">*</span></label>
                            <input type="number" id="expense_amount" name="amount" value="{{ old('amount') }}" required min="1"
                                   class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                                   placeholder="500000">
                        </div>
                        <div>
                            <label for="expense_date" class="block text-sm font-medium text-text mb-1.5">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" id="expense_date" name="date" value="{{ old('date', date('Y-m-d')) }}" required
                                   class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        </div>
                        <div>
                            <label for="expense_status" class="block text-sm font-medium text-text mb-1.5">Status</label>
                            <select id="expense_status" name="status"
                                    class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                                <option value="rencana" {{ old('status', 'rencana') === 'rencana' ? 'selected' : '' }}>Rencana</option>
                                <option value="terlaksana" {{ old('status') === 'terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
                                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah
                            </button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="expense_description" class="block text-sm font-medium text-text mb-1.5">Keterangan (opsional)</label>
                        <textarea id="expense_description" name="description" rows="2"
                                  class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y"
                                  placeholder="Deskripsi atau catatan tambahan...">{{ old('description') }}</textarea>
                    </div>
                </form>
            </div>

            {{-- Expenses Filters --}}
            <div class="bg-surface rounded-xl shadow-card p-4">
                <form method="GET" class="flex flex-col sm:flex-row gap-3">
                    <input type="hidden" name="tab" value="expenses">
                    <input type="text" name="expense_search" value="{{ request('expense_search') }}" placeholder="Cari judul pengeluaran..."
                           class="flex-1 px-4 py-2 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <select name="expense_status" class="px-4 py-2 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <option value="">Semua Status</option>
                        <option value="rencana" {{ request('expense_status') === 'rencana' ? 'selected' : '' }}>Rencana</option>
                        <option value="terlaksana" {{ request('expense_status') === 'terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-background text-text text-sm font-medium rounded-lg hover:bg-border transition-fast">Filter</button>
                </form>
            </div>

            {{-- Expenses Table --}}
            <div class="bg-surface rounded-xl shadow-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-background">
                            <tr>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">#</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Judul</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Jumlah</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Tanggal</th>
                                <th class="text-left px-6 py-3 font-semibold text-text-light">Status</th>
                                <th class="text-right px-6 py-3 font-semibold text-text-light">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border">
                            @forelse($expenses as $expense)
                                <tr class="hover:bg-background/50 transition-fast">
                                    <td class="px-6 py-4 text-text-light">{{ $loop->iteration + ($expenses->currentPage() - 1) * $expenses->perPage() }}</td>
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-heading">{{ $expense->title }}</p>
                                        @if($expense->description)
                                            <p class="text-xs text-text-light mt-0.5 truncate max-w-xs">{{ $expense->description }}</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-danger">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-text-light">{{ $expense->date->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
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
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- Toggle Status --}}
                                            <form method="POST" action="{{ route('admin.buku-kas.expenses.toggle', $expense) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="p-2 rounded-lg text-text-light hover:text-accent hover:bg-green-50 transition-fast"
                                                        title="{{ $expense->isTerlaksana() ? 'Ubah ke Rencana' : 'Tandai Terlaksana' }}">
                                                    @if($expense->isTerlaksana())
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    @endif
                                                </button>
                                            </form>
                                            {{-- Edit Button --}}
                                            <button onclick="openEditExpenseModal({{ $expense->id }}, '{{ addslashes($expense->title) }}', {{ $expense->amount }}, '{{ $expense->date->format('Y-m-d') }}', '{{ $expense->status }}', '{{ addslashes($expense->description ?? '') }}')"
                                                    class="p-2 rounded-lg text-text-light hover:text-info hover:bg-blue-50 transition-fast" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </button>
                                            {{-- Delete --}}
                                            <form method="POST" action="{{ route('admin.buku-kas.expenses.destroy', $expense) }}" onsubmit="return confirm('Yakin ingin menghapus data pengeluaran ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 rounded-lg text-text-light hover:text-danger hover:bg-red-50 transition-fast" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-text-light">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        <p>Belum ada data pengeluaran.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($expenses->hasPages())
                    <div class="px-6 py-4 border-t border-border">
                        {{ $expenses->links() }}
                    </div>
                @endif
            </div>
        </div>

</div>

{{-- ============================================================ --}}
{{-- EDIT DONOR MODAL --}}
{{-- ============================================================ --}}
<div id="editDonorModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50" onclick="closeEditDonorModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-surface rounded-2xl shadow-elevated w-full max-w-lg relative">
            <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                <h3 class="font-heading font-semibold text-heading">Edit Data Donatur</h3>
                <button onclick="closeEditDonorModal()" class="p-1 rounded-lg hover:bg-background transition-fast text-text-light">&times;</button>
            </div>
            <form id="editDonorForm" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Nama Donatur <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_donor_name" required
                               class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Jumlah (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="amount" id="edit_donor_amount" required min="1"
                               class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="date" id="edit_donor_date" required
                               class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_anonymous" value="1" id="edit_donor_anonymous"
                               class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30">
                        <span class="text-sm text-text">Anonim (Hamba Allah)</span>
                    </label>
                </div>
                <div class="px-6 py-4 border-t border-border flex justify-end gap-3">
                    <button type="button" onclick="closeEditDonorModal()" class="px-4 py-2 border border-border text-text text-sm font-medium rounded-lg hover:bg-background transition-fast">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- EDIT EXPENSE MODAL --}}
{{-- ============================================================ --}}
<div id="editExpenseModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50" onclick="closeEditExpenseModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-surface rounded-2xl shadow-elevated w-full max-w-lg relative">
            <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                <h3 class="font-heading font-semibold text-heading">Edit Pengeluaran / RAB</h3>
                <button onclick="closeEditExpenseModal()" class="p-1 rounded-lg hover:bg-background transition-fast text-text-light">&times;</button>
            </div>
            <form id="editExpenseForm" method="POST">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Judul <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit_expense_title" required
                               class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Jumlah (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="amount" id="edit_expense_amount" required min="1"
                               class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="date" id="edit_expense_date" required
                               class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Status</label>
                        <select name="status" id="edit_expense_status"
                                class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                            <option value="rencana">Rencana</option>
                            <option value="terlaksana">Terlaksana</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-text mb-1.5">Keterangan (opsional)</label>
                        <textarea name="description" id="edit_expense_description" rows="2"
                                  class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y"></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-border flex justify-end gap-3">
                    <button type="button" onclick="closeEditExpenseModal()" class="px-4 py-2 border border-border text-text text-sm font-medium rounded-lg hover:bg-background transition-fast">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // --- Tab Switching ---
    function switchTab(tab) {
        // Hide all tab contents
        document.getElementById('tab-donors').style.display = 'none';
        document.getElementById('tab-expenses').style.display = 'none';

        // Reset all tab buttons
        document.getElementById('tab-btn-donors').className = 'px-1 pb-3 text-sm font-medium border-b-2 transition-fast border-transparent text-text-light hover:text-text hover:border-border';
        document.getElementById('tab-btn-expenses').className = 'px-1 pb-3 text-sm font-medium border-b-2 transition-fast border-transparent text-text-light hover:text-text hover:border-border';

        // Show selected tab
        document.getElementById('tab-' + tab).style.display = 'block';
        document.getElementById('tab-btn-' + tab).className = 'px-1 pb-3 text-sm font-medium border-b-2 transition-fast border-primary text-primary';
    }

    // Auto-switch to correct tab based on URL param
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab') || 'donors';
        switchTab(tab);
    });

    // --- Edit Donor Modal ---
    function openEditDonorModal(id, name, amount, date, isAnonymous) {
        document.getElementById('editDonorForm').action = '{{ url("admin/buku-kas/donors") }}/' + id;
        document.getElementById('edit_donor_name').value = name;
        document.getElementById('edit_donor_amount').value = amount;
        document.getElementById('edit_donor_date').value = date;
        document.getElementById('edit_donor_anonymous').checked = isAnonymous;
        document.getElementById('editDonorModal').classList.remove('hidden');
    }

    function closeEditDonorModal() {
        document.getElementById('editDonorModal').classList.add('hidden');
    }

    // --- Edit Expense Modal ---
    function openEditExpenseModal(id, title, amount, date, status, description) {
        document.getElementById('editExpenseForm').action = '{{ url("admin/buku-kas/expenses") }}/' + id;
        document.getElementById('edit_expense_title').value = title;
        document.getElementById('edit_expense_amount').value = amount;
        document.getElementById('edit_expense_date').value = date;
        document.getElementById('edit_expense_status').value = status;
        document.getElementById('edit_expense_description').value = description;
        document.getElementById('editExpenseModal').classList.remove('hidden');
    }

    function closeEditExpenseModal() {
        document.getElementById('editExpenseModal').classList.add('hidden');
    }

    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditDonorModal();
            closeEditExpenseModal();
        }
    });
</script>
@endpush
