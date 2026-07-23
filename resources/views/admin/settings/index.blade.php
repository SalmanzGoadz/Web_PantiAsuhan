@extends('admin.layouts.app')
@section('title', 'Pengaturan Situs')
@section('page-title', 'Pengaturan Situs')

@section('content')
<div class="space-y-8">

    {{-- Identitas Umum --}}
    <div class="bg-surface rounded-xl shadow-card">
        <div class="px-6 py-4 border-b border-border">
            <h2 class="font-heading font-semibold text-heading">Identitas Umum</h2>
            <p class="text-xs text-text-light mt-1">Nama panti, deskripsi, dan logo</p>
        </div>
        <form method="POST" action="{{ route('admin.settings.update-general') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label for="site_name" class="block text-sm font-medium text-text mb-1.5">Nama Panti/Yayasan <span class="text-danger">*</span></label>
                <input type="text" id="site_name" name="site_name" value="{{ $settings['site_name'] ?? '' }}" required
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>
            <div>
                <label for="site_description" class="block text-sm font-medium text-text mb-1.5">Deskripsi Singkat</label>
                <textarea id="site_description" name="site_description" rows="3"
                          class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y">{{ $settings['site_description'] ?? '' }}</textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-text mb-1.5">Logo Utama</label>
                    @if(!empty($settings['logo_primary']))
                        <img src="{{ asset('storage/' . $settings['logo_primary']) }}" alt="Logo" class="h-12 mb-2">
                    @endif
                    <input type="file" name="logo_primary" accept="image/*"
                           class="w-full text-sm text-text file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-primary/10 file:text-primary file:cursor-pointer">
                </div>
                <div>
                    <label class="block text-sm font-medium text-text mb-1.5">Logo Kedua (Opsional)</label>
                    @if(!empty($settings['logo_secondary']))
                        <img src="{{ asset('storage/' . $settings['logo_secondary']) }}" alt="Logo 2" class="h-12 mb-2">
                    @endif
                    <input type="file" name="logo_secondary" accept="image/*"
                           class="w-full text-sm text-text file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-primary/10 file:text-primary file:cursor-pointer">
                </div>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast">Simpan</button>
        </form>
    </div>

    {{-- Kontak --}}
    <div class="bg-surface rounded-xl shadow-card">
        <div class="px-6 py-4 border-b border-border">
            <h2 class="font-heading font-semibold text-heading">Kontak & WhatsApp</h2>
        </div>
        <form method="POST" action="{{ route('admin.settings.update-contact') }}" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label for="address" class="block text-sm font-medium text-text mb-1.5">Alamat Lengkap</label>
                <textarea id="address" name="address" rows="2" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y">{{ $settings['address'] ?? '' }}</textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="phone" class="block text-sm font-medium text-text mb-1.5">Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ $settings['phone'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="024-XXXXXXX">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-text mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ $settings['email'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="whatsapp_number" class="block text-sm font-medium text-text mb-1.5">Nomor WhatsApp (Floating Button)</label>
                    <input type="text" id="whatsapp_number" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="6281234567890">
                    <p class="text-xs text-text-light mt-1">Format: 628xxx (tanpa +)</p>
                </div>
                <div>
                    <label for="whatsapp_message" class="block text-sm font-medium text-text mb-1.5">Pesan Default WA</label>
                    <input type="text" id="whatsapp_message" name="whatsapp_message" value="{{ $settings['whatsapp_message'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="Assalamu'alaikum, saya ingin bertanya...">
                </div>
            </div>
            <div>
                <label for="google_maps_embed" class="block text-sm font-medium text-text mb-1.5">Google Maps Embed URL</label>
                <input type="text" id="google_maps_embed" name="google_maps_embed" value="{{ $settings['google_maps_embed'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="https://www.google.com/maps/embed?pb=...">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast">Simpan</button>
        </form>
    </div>

    {{-- Sosial Media --}}
    <div class="bg-surface rounded-xl shadow-card">
        <div class="px-6 py-4 border-b border-border">
            <h2 class="font-heading font-semibold text-heading">Sosial Media</h2>
        </div>
        <form method="POST" action="{{ route('admin.settings.update-social') }}" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="instagram" class="block text-sm font-medium text-text mb-1.5">Instagram</label>
                    <input type="url" id="instagram" name="instagram" value="{{ $settings['instagram'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="https://instagram.com/...">
                </div>
                <div>
                    <label for="facebook" class="block text-sm font-medium text-text mb-1.5">Facebook</label>
                    <input type="url" id="facebook" name="facebook" value="{{ $settings['facebook'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="https://facebook.com/...">
                </div>
                <div>
                    <label for="youtube" class="block text-sm font-medium text-text mb-1.5">YouTube</label>
                    <input type="url" id="youtube" name="youtube" value="{{ $settings['youtube'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="https://youtube.com/...">
                </div>
                <div>
                    <label for="tiktok" class="block text-sm font-medium text-text mb-1.5">TikTok</label>
                    <input type="url" id="tiktok" name="tiktok" value="{{ $settings['tiktok'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="https://tiktok.com/...">
                </div>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast">Simpan</button>
        </form>
    </div>

    {{-- Donasi --}}
    <div class="bg-surface rounded-xl shadow-card">
        <div class="px-6 py-4 border-b border-border">
            <h2 class="font-heading font-semibold text-heading">Informasi Donasi</h2>
            <p class="text-xs text-text-light mt-1">Nomor rekening dan QRIS untuk halaman donasi</p>
        </div>
        <form method="POST" action="{{ route('admin.settings.update-donation') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="bank_name" class="block text-sm font-medium text-text mb-1.5">Nama Bank</label>
                    <input type="text" id="bank_name" name="bank_name" value="{{ $settings['bank_name'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary" placeholder="BSI / BRI / Mandiri">
                </div>
                <div>
                    <label for="bank_account_number" class="block text-sm font-medium text-text mb-1.5">Nomor Rekening</label>
                    <input type="text" id="bank_account_number" name="bank_account_number" value="{{ $settings['bank_account_number'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label for="bank_account_name" class="block text-sm font-medium text-text mb-1.5">Nama Pemilik Rekening</label>
                    <input type="text" id="bank_account_name" name="bank_account_name" value="{{ $settings['bank_account_name'] ?? '' }}" class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-text mb-1.5">Gambar QRIS</label>
                @if(!empty($settings['qris_image']))
                    <img src="{{ asset('storage/' . $settings['qris_image']) }}" alt="QRIS" class="w-48 rounded-lg mb-3">
                @endif
                <input type="file" name="qris_image" accept="image/*"
                       class="w-full text-sm text-text file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-primary/10 file:text-primary file:cursor-pointer">
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast">Simpan</button>
        </form>
    </div>

    {{-- CMS Pages --}}
    @foreach([
        ['slug' => 'tentang-kami', 'label' => 'Halaman Tentang Kami', 'page' => $pageAbout],
        ['slug' => 'visi-misi', 'label' => 'Halaman Visi & Misi', 'page' => $pageVisiMisi],
        ['slug' => 'sop-pengasuhan', 'label' => 'Halaman SOP Pengasuhan', 'page' => $pageSop],
    ] as $pageData)
    <div class="bg-surface rounded-xl shadow-card">
        <div class="px-6 py-4 border-b border-border">
            <h2 class="font-heading font-semibold text-heading">{{ $pageData['label'] }}</h2>
        </div>
        <form method="POST" action="{{ route('admin.settings.update-page', $pageData['slug']) }}" class="p-6 space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-text mb-1.5">Judul Halaman</label>
                <input type="text" name="title" value="{{ $pageData['page']->title ?? ucfirst(str_replace('-', ' ', $pageData['slug'])) }}" required
                       class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
            </div>
            <div>
                <label class="block text-sm font-medium text-text mb-1.5">Konten</label>
                <textarea name="content" rows="10"
                          class="tinymce w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary resize-y">{{ $pageData['page']->content ?? '' }}</textarea>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-text mb-1.5">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ $pageData['page']->meta_title ?? '' }}"
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-text mb-1.5">Meta Description</label>
                    <input type="text" name="meta_description" value="{{ $pageData['page']->meta_description ?? '' }}"
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
            </div>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white font-semibold text-sm rounded-lg hover:bg-primary-dark transition-fast">Simpan</button>
        </form>
    </div>
    @endforeach

</div>
@endsection
