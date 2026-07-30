{{-- Form Kirim Donasi Baru --}}
{{-- Donatur mengirim donasi: jumlah, upload bukti transfer, doa & harapan --}}
@extends('donatur.layouts.app')

@section('title', 'Kirim Donasi')

@section('content')

{{-- Breadcrumb --}}
<div class="mb-6">
    <a href="{{ route('donatur.dashboard') }}" class="inline-flex items-center gap-1 text-sm text-text-light hover:text-green-800 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Dashboard
    </a>
</div>

{{-- Header --}}
<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-heading font-bold text-green-900 mb-2">Kirim Donasi</h1>
    <p class="text-text-light">Isi form di bawah ini untuk mengirimkan donasi Anda. Pastikan bukti transfer sudah siap.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    {{-- Form Donasi --}}
    <div class="lg:col-span-2">
        <div class="bg-surface rounded-xl shadow-card border border-border p-6 sm:p-8">
            <form method="POST" action="{{ route('donatur.donation.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Jumlah Donasi --}}
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-semibold text-heading mb-2">Jumlah Donasi (Rp) <span class="text-red-500">*</span></label>
                    <input type="number"
                           id="amount"
                           name="amount"
                           value="{{ old('amount') }}"
                           required
                           min="1000"
                           step="1000"
                           class="w-full px-4 py-3 border border-border rounded-xl text-sm text-text bg-white
                                  focus:outline-none focus:ring-2 focus:ring-green-800/30 focus:border-green-800
                                  transition-fast"
                           placeholder="Contoh: 100000">
                    @error('amount')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Bukti Transfer --}}
                <div class="mb-6">
                    <label for="proof_image" class="block text-sm font-semibold text-heading mb-2">Bukti Transfer <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="file"
                               id="proof_image"
                               name="proof_image"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               required
                               class="w-full px-4 py-3 border border-dashed border-border rounded-xl text-sm text-text bg-white
                                      file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0
                                      file:text-sm file:font-medium file:bg-green-800/10 file:text-green-800
                                      hover:file:bg-green-800/20 cursor-pointer
                                      focus:outline-none focus:ring-2 focus:ring-green-800/30 focus:border-green-800
                                      transition-fast">
                    </div>
                    <p class="text-xs text-text-light mt-1">Format: JPEG, PNG, JPG, atau WebP. Maks: 2MB.</p>
                    @error('proof_image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    {{-- Preview Gambar --}}
                    <div id="image-preview" class="mt-3 hidden">
                        <img id="preview-img" src="#" alt="Preview" class="max-h-40 rounded-lg border border-border">
                    </div>
                </div>

                {{-- Doa & Harapan (Opsional) --}}
                <div class="mb-6">
                    <label for="prayer" class="block text-sm font-semibold text-heading mb-2">Doa & Harapan <span class="text-text-light font-normal">(Opsional)</span></label>
                    <textarea id="prayer"
                              name="prayer"
                              rows="4"
                              maxlength="500"
                              class="w-full px-4 py-3 border border-border rounded-xl text-sm text-text bg-white resize-none
                                     focus:outline-none focus:ring-2 focus:ring-green-800/30 focus:border-green-800
                                     transition-fast"
                              placeholder="Tuliskan doa & harapan Anda untuk anak-anak panti asuhan...">{{ old('prayer') }}</textarea>
                    <p class="text-xs text-text-light mt-1">Doa Anda akan ditampilkan di halaman utama setelah donasi tervalidasi. Maks: 500 karakter.</p>
                    @error('prayer')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Checkbox Anonim --}}
                <div class="mb-8">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="is_anonymous" value="1"
                               {{ old('is_anonymous') ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-border text-green-800 focus:ring-green-800/30 mt-0.5">
                        <div>
                            <span class="text-sm font-medium text-text">Sembunyikan nama saya (Hamba Allah)</span>
                            <p class="text-xs text-text-light mt-0.5">Nama Anda akan ditampilkan sebagai "Hamba Allah" di daftar donatur publik.</p>
                        </div>
                    </label>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-green-800 text-white font-semibold rounded-xl
                               hover:bg-green-900 active:scale-[0.98]
                               transition-all duration-200 shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Donasi
                </button>
            </form>
        </div>
    </div>

    {{-- Panduan --}}
    <div class="lg:col-span-1">
        <div class="bg-green-800/5 rounded-xl border border-green-800/10 p-6 sticky top-24">
            <h3 class="font-heading font-bold text-green-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Panduan Donasi
            </h3>
            <ol class="text-sm text-green-900/80 space-y-3">
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-green-800 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">1</span>
                    Transfer donasi ke rekening yang tertera di halaman <a href="{{ route('donation') }}" class="underline font-medium" target="_blank">Donasi</a>.
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-green-800 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">2</span>
                    Screenshot atau foto bukti transfer Anda.
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-green-800 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">3</span>
                    Isi form ini dengan jumlah donasi dan upload bukti transfer.
                </li>
                <li class="flex items-start gap-2">
                    <span class="w-5 h-5 rounded-full bg-green-800 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">4</span>
                    Admin akan memvalidasi donasi Anda dalam 1-2 hari kerja.
                </li>
            </ol>

            <div class="mt-6 p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                <p class="text-xs text-yellow-800 flex items-start gap-2">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    Donasi yang belum divalidasi admin berstatus "Menunggu" dan belum masuk ke total saldo keuangan.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Preview gambar sebelum upload
    document.getElementById('proof_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
@endpush
