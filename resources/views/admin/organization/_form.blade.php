{{-- Organization member form partial --}}
<div class="max-w-2xl space-y-6">
    <div class="bg-surface rounded-xl shadow-card p-6 space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-text mb-1.5">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $member->name ?? '') }}" required
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>
            <div>
                <label for="position" class="block text-sm font-medium text-text mb-1.5">Jabatan <span class="text-danger">*</span></label>
                <input type="text" id="position" name="position" value="{{ old('position', $member->position ?? '') }}" required
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary"
                       placeholder="mis. Ketua Yayasan">
            </div>
        </div>

        <div>
            <label for="parent_id" class="block text-sm font-medium text-text mb-1.5">Atasan Langsung</label>
            <select id="parent_id" name="parent_id"
                    class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                <option value="">— Tidak ada (Pimpinan Tertinggi) —</option>
                @foreach($parentOptions as $option)
                    <option value="{{ $option->id }}" {{ old('parent_id', $member->parent_id ?? '') == $option->id ? 'selected' : '' }}>
                        {{ $option->name }} ({{ $option->position }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="level" class="block text-sm font-medium text-text mb-1.5">Level Hierarki</label>
                <input type="number" id="level" name="level" value="{{ old('level', $member->level ?? 0) }}" min="0" max="10"
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                <p class="text-xs text-text-light mt-1">0 = paling atas (Ketua), 1 = Wakil, dst.</p>
            </div>
            <div>
                <label for="sort_order" class="block text-sm font-medium text-text mb-1.5">Urutan</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $member->sort_order ?? 0) }}" min="0"
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-text mb-1.5">Foto</label>
            @if(isset($member) && $member->photo)
                <img src="{{ $member->photo_url }}" alt="" class="w-20 h-20 rounded-lg object-cover mb-3">
            @endif
            <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                   class="w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 file:cursor-pointer">
            <p class="text-xs text-text-light mt-2">JPG, PNG, WebP. Maks 2MB.</p>
        </div>

        <div>
            <label class="flex items-center gap-3 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', $member->is_active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30">
                <span class="text-sm font-medium text-text">Aktif</span>
            </label>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit" class="px-6 py-2.5 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast shadow-subtle">
            {{ isset($member) && $member->exists ? 'Simpan Perubahan' : 'Tambah Anggota' }}
        </button>
        <a href="{{ route('admin.organization.index') }}" class="px-6 py-2.5 border border-border text-text text-sm font-medium rounded-lg hover:bg-background transition-fast">Batal</a>
    </div>
</div>
