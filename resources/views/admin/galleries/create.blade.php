@extends('admin.layouts.app')

@section('title', 'Buat Album Galeri')
@section('page-title', 'Buat Album Galeri')

@section('content')
<form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label for="title" class="block text-sm font-medium text-text mb-1.5">Judul Album <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                       placeholder="Nama kegiatan / album">
            </div>
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label for="description" class="block text-sm font-medium text-text mb-1.5">Deskripsi</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y"
                          placeholder="Deskripsi singkat album (opsional)">{{ old('description') }}</textarea>
            </div>
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label class="block text-sm font-medium text-text mb-3">Upload Foto</label>
                <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
                <p class="text-xs text-text-light mt-2">Pilih beberapa foto sekaligus. JPG, PNG, WebP. Maks 5MB per file.</p>
            </div>
        </div>
        <div class="space-y-6">
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label for="published_at" class="block text-sm font-medium text-text mb-1.5">Tanggal Publish</label>
                <input type="date" id="published_at" name="published_at" value="{{ old('published_at', date('Y-m-d')) }}"
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>
            <div class="bg-surface rounded-xl shadow-card p-6">
                <label class="block text-sm font-medium text-text mb-1.5">Cover Album</label>
                <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
                       class="w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
                <p class="text-xs text-text-light mt-2">Opsional. Jika kosong, foto pertama akan dipakai.</p>
            </div>
            <div class="bg-surface rounded-xl shadow-card p-6">
                <button type="submit" class="w-full py-2.5 px-4 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">Simpan Album</button>
                <a href="{{ route('admin.galleries.index') }}" class="block w-full text-center mt-3 py-2.5 px-4 border border-border text-text text-sm font-medium rounded-lg hover:bg-background transition-fast">Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection
