{{-- Hero Slide form partial --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-surface rounded-xl shadow-card p-6 space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-text mb-1.5">Judul Slide</label>
                <input type="text" id="title" name="title" value="{{ old('title', $slide->title ?? '') }}"
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                       placeholder="Judul besar pada slide">
            </div>
            <div>
                <label for="subtitle" class="block text-sm font-medium text-text mb-1.5">Subjudul</label>
                <textarea id="subtitle" name="subtitle" rows="2"
                          class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y"
                          placeholder="Deskripsi singkat di bawah judul">{{ old('subtitle', $slide->subtitle ?? '') }}</textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="cta_text" class="block text-sm font-medium text-text mb-1.5">Teks Tombol CTA</label>
                    <input type="text" id="cta_text" name="cta_text" value="{{ old('cta_text', $slide->cta_text ?? '') }}"
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                           placeholder="mis. Donasi Sekarang">
                </div>
                <div>
                    <label for="cta_link" class="block text-sm font-medium text-text mb-1.5">Link Tombol CTA</label>
                    <input type="text" id="cta_link" name="cta_link" value="{{ old('cta_link', $slide->cta_link ?? '') }}"
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                           placeholder="/donasi atau https://...">
                </div>
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <div class="bg-surface rounded-xl shadow-card p-6">
            <label class="block text-sm font-medium text-text mb-3">Gambar Slide {{ isset($slide) ? '' : '*' }}</label>
            @if(isset($slide) && $slide->image)
                <img src="{{ $slide->image_url }}" alt="Preview" class="w-full rounded-lg object-cover mb-3">
            @endif
            <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                   class="w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer"
                   {{ isset($slide) ? '' : 'required' }}>
            <p class="text-xs text-text-light mt-2">Rekomendasi: 1920×700px. Maks 5MB.</p>
        </div>
        <div class="bg-surface rounded-xl shadow-card p-6">
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', $slide->is_active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30">
                <span class="text-sm font-medium text-text">Aktifkan Slide</span>
            </label>
        </div>
        <div class="bg-surface rounded-xl shadow-card p-6">
            <button type="submit" class="w-full py-2.5 px-4 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
                {{ isset($slide) && $slide->exists ? 'Simpan Perubahan' : 'Simpan Slide' }}
            </button>
            <a href="{{ route('admin.hero-slides.index') }}" class="block w-full text-center mt-3 py-2.5 px-4 border border-border text-text text-sm font-medium rounded-lg hover:bg-background transition-fast">Batal</a>
        </div>
    </div>
</div>
