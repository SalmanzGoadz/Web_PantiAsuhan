@extends('admin.layouts.app')
@section('title', 'Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-heading text-xl font-bold text-heading">Pengurus Organisasi</h2>
            <p class="text-sm text-text-light mt-1">Kelola anggota dan struktur organisasi</p>
        </div>
        <a href="{{ route('admin.organization.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Anggota
        </a>
    </div>

    <div class="bg-surface rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-background">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Anggota</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Jabatan</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Atasan</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Level</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Status</th>
                        <th class="text-right px-6 py-3 font-semibold text-text-light">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($members as $member)
                        <tr class="hover:bg-background/50 transition-fast">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($member->photo)
                                        <img src="{{ $member->photo_url }}" alt="" class="w-10 h-10 rounded-full object-cover shrink-0">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                            <span class="text-sm font-semibold text-primary">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                    <span class="font-medium text-heading">{{ $member->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-text">{{ $member->position }}</td>
                            <td class="px-6 py-4 text-text-light">{{ $member->parent?->name ?? '— (Pimpinan)' }}</td>
                            <td class="px-6 py-4"><span class="px-2 py-0.5 bg-background text-text-light text-xs rounded-md">Level {{ $member->level }}</span></td>
                            <td class="px-6 py-4">
                                @if($member->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.organization.edit', $member) }}" class="p-2 rounded-lg text-text-light hover:text-info hover:bg-blue-50 transition-fast" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.organization.destroy', $member) }}" onsubmit="return confirm('Hapus anggota ini? Bawahan akan dipindah ke atasan anggota ini.')">
                                        @csrf @method('DELETE')
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
                                Belum ada anggota. <a href="{{ route('admin.organization.create') }}" class="text-primary hover:underline">Tambah anggota pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
