@extends('admin.layouts.app')

@section('title', 'Manajemen Berita')
@section('page-title', 'Manajemen Berita')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-heading text-xl font-bold text-heading">Daftar Berita</h2>
            <p class="text-sm text-text-light mt-1">Kelola semua artikel berita</p>
        </div>
        <a href="{{ route('admin.news.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tulis Berita
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-surface rounded-xl shadow-card p-4">
        <form method="GET" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul berita..."
                   class="flex-1 px-4 py-2 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            <select name="status" class="px-4 py-2 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-background text-text text-sm font-medium rounded-lg hover:bg-border transition-fast">
                Filter
            </button>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-surface rounded-xl shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-background">
                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">#</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Judul</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Status</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Tanggal Publish</th>
                        <th class="text-left px-6 py-3 font-semibold text-text-light">Penulis</th>
                        <th class="text-right px-6 py-3 font-semibold text-text-light">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($news as $item)
                        <tr class="hover:bg-background/50 transition-fast">
                            <td class="px-6 py-4 text-text-light">{{ $loop->iteration + ($news->currentPage() - 1) * $news->perPage() }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($item->cover_image)
                                        <img src="{{ $item->cover_image_url }}" alt="" class="w-12 h-9 rounded-md object-cover shrink-0">
                                    @else
                                        <div class="w-12 h-9 rounded-md bg-background flex items-center justify-center shrink-0">
                                            <svg class="w-5 h-5 text-text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-medium text-heading truncate">{{ $item->title }}</p>
                                        <p class="text-xs text-text-light truncate">{{ $item->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status === 'published')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Published</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Draft</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-text-light">
                                {{ $item->published_at ? $item->published_at->format('d M Y, H:i') : '—' }}
                            </td>
                            <td class="px-6 py-4 text-text-light">{{ $item->author?->name ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.news.edit', $item) }}"
                                       class="p-2 rounded-lg text-text-light hover:text-info hover:bg-blue-50 transition-fast" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.news.destroy', $item) }}" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
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
                                <svg class="w-12 h-12 mx-auto mb-3 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2"/></svg>
                                <p>Belum ada berita. <a href="{{ route('admin.news.create') }}" class="text-primary hover:underline">Tulis berita pertama</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($news->hasPages())
            <div class="px-6 py-4 border-t border-border">
                {{ $news->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
