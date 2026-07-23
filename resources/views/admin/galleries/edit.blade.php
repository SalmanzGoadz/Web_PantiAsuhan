@extends('admin.layouts.app')

@section('title', 'Edit Album Galeri')
@section('page-title', 'Edit Album Galeri')

@section('content')
<form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label for="title" class="block text-sm font-medium text-text mb-1.5">Judul Album <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $gallery->title) }}" required
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label for="description" class="block text-sm font-medium text-text mb-1.5">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y">{{ old('description', $gallery->description) }}</textarea>
            </div>

            {{-- Existing Images --}}
            @if($gallery->items->count())
            <div class="bg-surface rounded-xl shadow-card p-6">
                <h3 class="font-heading font-semibold text-heading mb-4">Foto dalam Album ({{ $gallery->items->count() }})</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($gallery->items as $item)
                        <div class="relative group rounded-lg overflow-hidden border border-border">
                            <img src="{{ $item->image_url }}" alt="{{ $item->caption }}" class="w-full aspect-square object-cover">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-default flex items-center justify-center">
                                <form method="POST" action="{{ route('admin.gallery-items.destroy', $item) }}" onsubmit="return confirm('Hapus foto ini?')" class="opacity-0 group-hover:opacity-100 transition-default">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-white rounded-lg text-danger hover:bg-red-50 shadow-card">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                            @if($item->caption)
                                <div class="absolute bottom-0 left-0 right-0 px-2 py-1 bg-black/60 text-white text-xs truncate">{{ $item->caption }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Add More Images --}}
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label class="block text-sm font-medium text-text mb-3">Tambah Foto Baru</label>
                <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
                <p class="text-xs text-text-light mt-2">Pilih foto tambahan. Foto yang ada tidak akan terhapus.</p>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label for="published_at" class="block text-sm font-medium text-text mb-1.5">Tanggal Publish</label>
                <input type="date" id="published_at" name="published_at"
                       value="{{ old('published_at', $gallery->published_at ? $gallery->published_at->format('Y-m-d') : '') }}"
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label class="block text-sm font-medium text-text mb-1.5">Cover Album</label>
                @if($gallery->cover_image)
                    <img src="{{ $gallery->cover_image_url }}" alt="Cover" class="w-full rounded-lg object-cover mb-3">
                @endif
                <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
            </div>
            <div class="bg-surface rounded-xl shadow-card p-6">
                <button type="submit" class="w-full py-2.5 px-4 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">Simpan Perubahan</button>
                <a href="{{ route('admin.galleries.index') }}" class="block w-full text-center mt-3 py-2.5 px-4 border border-border text-text text-sm font-medium rounded-lg hover:bg-background transition-fast">Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection
