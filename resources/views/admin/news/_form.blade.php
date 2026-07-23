{{-- Reusable news form partial --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Title --}}
        <div class="bg-surface rounded-xl shadow-card p-6">
            <label for="title" class="block text-sm font-medium text-text mb-1.5">Judul Berita <span class="text-danger">*</span></label>
            <input type="text" id="title" name="title" value="{{ old('title', $news->title ?? '') }}" required
                   class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                   placeholder="Masukkan judul berita">
        </div>

        {{-- Excerpt --}}
        <div class="bg-surface rounded-xl shadow-card p-6">
            <label for="excerpt" class="block text-sm font-medium text-text mb-1.5">Ringkasan (Excerpt)</label>
            <textarea id="excerpt" name="excerpt" rows="3"
                      class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y"
                      placeholder="Ringkasan singkat berita (opsional)">{{ old('excerpt', $news->excerpt ?? '') }}</textarea>
        </div>

        {{-- Content --}}
        <div class="bg-surface rounded-xl shadow-card p-6">
            <label for="content" class="block text-sm font-medium text-text mb-1.5">Konten <span class="text-danger">*</span></label>
            <textarea id="content" name="content" rows="15"
                      class="tinymce w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y"
                      placeholder="Tulis konten berita di sini...">{{ old('content', $news->content ?? '') }}</textarea>
            <p class="text-xs text-text-light mt-2">Mendukung rich text formatting.</p>
        </div>

        {{-- SEO --}}
        <div class="bg-surface rounded-xl shadow-card p-6">
            <h3 class="font-heading font-semibold text-heading mb-4">SEO</h3>
            <div class="space-y-4">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-text mb-1.5">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $news->meta_title ?? '') }}"
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                           placeholder="Meta title untuk SEO (opsional)">
                </div>
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-text mb-1.5">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="2"
                              class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y"
                              placeholder="Meta description untuk SEO (opsional)">{{ old('meta_description', $news->meta_description ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-6">
        {{-- Publish Settings --}}
        <div class="bg-surface rounded-xl shadow-card p-6">
            <h3 class="font-heading font-semibold text-heading mb-4">Pengaturan Publish</h3>
            <div class="space-y-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-text mb-1.5">Status</label>
                    <select id="status" name="status"
                            class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <option value="draft" {{ old('status', $news->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $news->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div>
                    <label for="published_at" class="block text-sm font-medium text-text mb-1.5">Tanggal Publish</label>
                    <input type="datetime-local" id="published_at" name="published_at"
                           value="{{ old('published_at', isset($news) && $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <p class="text-xs text-text-light mt-1">Kosongkan untuk publish sekarang.</p>
                </div>
            </div>
        </div>

        {{-- Cover Image --}}
        <div class="bg-surface rounded-xl shadow-card p-6">
            <h3 class="font-heading font-semibold text-heading mb-4">Cover Image</h3>
            @if(isset($news) && $news->cover_image)
                <div class="mb-4">
                    <img src="{{ $news->cover_image_url }}" alt="Cover" class="w-full rounded-lg object-cover">
                    <p class="text-xs text-text-light mt-2">Unggah gambar baru untuk mengganti.</p>
                </div>
            @endif
            <input type="file" name="cover_image" accept="image/jpeg,image/png,image/webp"
                   class="w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
            <p class="text-xs text-text-light mt-2">JPG, PNG, WebP. Maks 5MB.</p>
        </div>

        {{-- Actions --}}
        <div class="bg-surface rounded-xl shadow-card p-6">
            <button type="submit" class="w-full py-2.5 px-4 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
                {{ isset($news) ? 'Simpan Perubahan' : 'Simpan Berita' }}
            </button>
            <a href="{{ route('admin.news.index') }}" class="block w-full text-center mt-3 py-2.5 px-4 border border-border text-text text-sm font-medium rounded-lg hover:bg-background transition-fast">
                Batal
            </a>
        </div>
    </div>
</div>
