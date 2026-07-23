# PRD (Product Requirements Document)
## Website Panti Asuhan — Yayasan Islam

| | |
|---|---|
| **Versi** | 1.1 (Final — Fase 1) |
| **Status** | Disetujui — siap lanjut ke Fase 2 |
| **Tech Stack Utama** | Laravel |

---

## 1. Ringkasan Proyek

Website profil & informasi resmi untuk sebuah Panti Asuhan di bawah Yayasan Islam. Website bersifat **read-only untuk publik** (tanpa registrasi/login pengguna) dan dikelola melalui **panel admin (CMS)** oleh pengurus panti untuk mengelola konten: berita, galeri kegiatan, dan struktur organisasi.

Tujuan utama:
- Media informasi resmi & transparansi yayasan kepada masyarakat/donatur.
- Memudahkan pengurus mengupdate konten tanpa bantuan developer (self-service CMS).
- Membangun kepercayaan publik melalui transparansi struktur organisasi & kegiatan.

---

## 2. Target Pengguna

| Role | Akses | Login? |
|---|---|---|
| **Pengunjung Publik** | Lihat semua halaman informasi (read-only) | ❌ Tidak ada login |
| **Admin/Pengurus Panti** | CRUD Berita, Galeri, Struktur Organisasi, Pengaturan Situs | ✅ Login wajib |

> Catatan: Tidak ada sistem akun untuk pengunjung. Tidak ada fitur komentar/interaksi user yang butuh identitas, sesuai instruksi.

---

## 3. Tech Stack

| Layer | Teknologi | Alasan |
|---|---|---|
| Backend Framework | **Laravel 11 (PHP 8.3+)** | Sesuai keputusan Anda |
| Admin Panel/CMS | **Custom Admin Panel (Blade + Laravel)** ✅ *dikonfirmasi* | Dibangun manual di atas Laravel — controller, route, view khusus admin. Lebih fleksibel untuk kebutuhan spesifik (hero slider, org chart dinamis, WA popup) dibanding paket admin generik |
| Frontend Publik | **Blade + Tailwind CSS** | Native Laravel, ringan, mudah dipetakan ke design tokens dari `design.md` Anda |
| Database | **MySQL 8** | Standar Laravel, kompatibel luas dengan hosting |
| Media Storage | Local disk (`storage/app/public`) untuk awal; opsi migrasi ke **S3-compatible** (mis. Cloudflare R2) bila traffic/gambar besar | Efisiensi biaya di tahap awal |
| Image Processing | **Intervention/Image** atau `spatie/laravel-media-library` | Resize/optimize otomatis saat upload (thumbnail, WebP) |
| Search Engine (opsional) | Laravel Scout + database driver | Jika berita/galeri jumlahnya banyak dan butuh pencarian |
| Diagram Struktur Organisasi | **Data-driven (Opsi B)** ✅ *dikonfirmasi* — dirender sebagai chart/tree (CSS tree custom atau library ringan seperti `orgchart.js`) dari data `organization_members` | Admin cukup input nama/jabatan/atasan, diagram ter-generate otomatis, tidak perlu edit gambar manual tiap ada perubahan pengurus |
| Hosting | VPS (Ubuntu 22.04 + Nginx + PHP-FPM + Supervisor) **atau** shared hosting cPanel Laravel-ready | Tergantung budget klien — dibahas di Fase 5 |
| Version Control | Git + repository privat | Standar |

---

## 4. Sitemap — Halaman Publik

```
/                       → Beranda (Hero Carousel 3 slide, ringkasan visi-misi, berita terbaru, CTA donasi)
/tentang-kami           → Sejarah, Visi & Misi Yayasan
/struktur-organisasi    → Diagram struktur pengurus panti
/sop-pengasuhan         → SOP Pengasuhan Anak (halaman konten statis/CMS)
/berita                 → Daftar berita (paginated)
/berita/{slug}          → Detail berita
/galeri                 → Daftar galeri kegiatan (grid/album)
/galeri/{slug}          → Detail album galeri (lightbox)
/donasi                 → Informasi donasi (rekening/QRIS)
/kontak                 → Form kontak, alamat, peta (embed Google Maps), sosial media

[Komponen Global — tampil di semua halaman]
Floating WhatsApp Button → Popup kontak cepat ke pengurus (klik kanan-bawah layar)
```

Admin (terpisah, tidak terindeks search engine):
```
/admin/login
/admin/dashboard
/admin/berita           (CRUD)
/admin/galeri           (CRUD)
/admin/struktur         (CRUD anggota/jabatan pengurus)
/admin/hero-slider      (CRUD slide beranda: gambar, judul, subjudul, tombol CTA)
/admin/pengaturan       (alamat, kontak, sosmed, info rekening donasi, nomor WA, logo)
```

---

## 4.1 Komponen Layout Global (Navbar & Footer)

Berdasarkan referensi desain yang diberikan (screenshot situs Panti Asuhan Muhammadiyah Semarang), berikut komponen layout yang tampil di **semua halaman**:

### Navbar (Header)
- **Dua logo berdampingan** di sisi kiri navbar: logo utama yayasan/panti + logo kedua (mis. logo program/induk organisasi, seperti "AUMSOS" pada referensi), diikuti nama panti & sub-teks (mis. "YAYASAN KESEJAHTERAAN SOSIAL").
- Menu navigasi horizontal (Beranda, Profil, Kegiatan, Berita, dst — menyesuaikan sitemap final).
- Tombol CTA menonjol di ujung kanan (mis. "Donasi Sekarang") menggunakan warna primary `#ff6b00`.
- Kedua logo & nama panti diatur dari `/admin/pengaturan` (upload logo utama & logo kedua) agar tidak hardcode di kode.

### Footer
Mengikuti struktur pada referensi gambar, footer terdiri dari 4 kolom (desktop) yang menyusun jadi 1 kolom vertikal di mobile:
1. **Kolom Identitas** — dua logo (sama seperti navbar), nama panti, deskripsi singkat yayasan (dikelola via CMS/`site_settings`), dan ikon sosial media (Instagram, WhatsApp, Email, dll — link dari `site_settings`).
2. **Tautan Cepat** — daftar link internal (mis. Profil Yayasan, Program Kegiatan, Berita & Artikel, Cara Berdonasi) — mengarah ke halaman-halaman di Section 4.
3. **Hubungi Kami** — alamat lengkap, nomor telepon, dan email, masing-masing dengan ikon — seluruhnya dari `site_settings`.
4. **Peta Lokasi** — embed Google Maps (di atas footer, sebelum kolom footer dimulai) menunjukkan lokasi panti.
- **Baris copyright** di bagian paling bawah: `© {tahun berjalan} Yayasan [Nama Panti]. Hak Cipta Dilindungi.` — tahun digenerate otomatis (bukan hardcode).

> Kedua logo (navbar & footer) memakai sumber gambar yang sama — disimpan sekali di `site_settings` (`logo_primary`, `logo_secondary`) agar konsisten dan mudah diupdate di satu tempat.

---

## 5. Modul & Fitur

### 5.1 Modul Publik
- **Hero Carousel (Beranda)** — slider 3 gambar (auto-play + tombol navigasi `<` `>` + indikator dot), tiap slide punya judul besar, subjudul/deskripsi, dan tombol CTA (mis. "Salurkan Sedekah/Donasi") yang bisa diarahkan ke halaman/link berbeda per slide. Sepenuhnya dikelola dari admin (gambar, teks, urutan slide bisa diganti tanpa sentuh kode).
- **Beranda** — selain hero, menampilkan ringkasan nilai/value (ikon: Mandiri, Beriman, dst — opsional dikelola statis atau via CMS), berita terbaru, galeri terbaru, quick links.
- **Tentang Kami** — konten statis dikelola via CMS (WYSIWYG editor di admin).
- **Struktur Organisasi** — diagram dinamis (tree/chart), digenerate otomatis dari data pengurus yang diinput admin (nama, jabatan, foto, level/hierarki).
- **SOP Pengasuhan Anak** — halaman konten (rich text, bisa berisi dokumen/PDF unduhan).
- **Berita** — listing + detail, kategori/tag opsional, share ke sosmed.
- **Galeri Kegiatan** — album/grid foto, dikelompokkan per kegiatan/tanggal.
- **Donasi** — halaman informasi saja: nomor rekening bank, nama pemilik rekening, dan/atau gambar QRIS. **Tanpa transaksi online / payment gateway.**
- **Floating WhatsApp Popup** — tombol mengambang (biasanya kanan-bawah) muncul di semua halaman. Saat diklik, membuka popup kecil berisi salam singkat + tombol "Chat via WhatsApp" yang mengarah ke `wa.me/{nomor}` dengan pesan default (mis. "Assalamu'alaikum, saya ingin bertanya tentang donasi..."). Nomor WA diatur dari `/admin/pengaturan`.
- **Kontak** — alamat, nomor WA/telepon, email, link sosial media, embed peta.
- **SEO dasar** — meta title/description per halaman, sitemap.xml, robots.txt, Open Graph tags (penting untuk keperluan share berita ke sosmed).

### 5.2 Modul Admin (CMS) — Custom Admin Panel
- **Autentikasi Admin** — login, logout, reset password via email (form & controller custom, bukan paket admin siap pakai).
- **Manajemen Hero Slider** — CRUD slide beranda (upload gambar, judul, subjudul, teks & link tombol CTA, urutan slide, aktif/nonaktif).
- **Manajemen Berita** — create/edit/delete, upload gambar cover, rich text editor, status draft/publish, penjadwalan tanggal publish.
- **Manajemen Galeri** — buat album, upload multi-gambar, edit caption, hapus.
- **Manajemen Struktur Organisasi** — tambah/edit/hapus anggota pengurus (nama, jabatan, foto, atasan langsung/`parent`, urutan) — otomatis membentuk diagram di frontend.
- **Pengaturan Situs** — edit alamat, kontak, nomor WhatsApp (untuk popup), link sosial media, info rekening donasi/QRIS, konten SOP & Visi-Misi, logo navbar/footer.
- **Activity Log** — mencatat siapa mengubah/menghapus apa dan kapan (audit trail dasar).

---

## 6. Struktur Database (Draf Awal)

```
users (admin — akun tunggal)
 ├─ id, name, email, password, created_at...

news (berita)
 ├─ id, title, slug, excerpt, content (TEXT/rich text), cover_image,
 │   status (draft/published), published_at, author_id (FK users),
 │   meta_title, meta_description, created_at, updated_at

hero_slides (slider beranda)
 ├─ id, image, title, subtitle, cta_text, cta_link,
 │   sort_order, is_active, created_at

galleries (album)
 ├─ id, title, slug, description, cover_image, published_at, created_at

gallery_items (foto dalam album)
 ├─ id, gallery_id (FK), image_path, caption, sort_order

organization_members (struktur organisasi)
 ├─ id, name, position, photo, parent_id (FK self — untuk hierarki),
 │   sort_order, level, is_active

pages (konten statis: tentang kami, visi-misi, sop)
 ├─ id, slug (unique: 'tentang-kami', 'sop-pengasuhan', dst),
 │   title, content, updated_at

site_settings (key-value, untuk kontak/sosmed/rekening donasi)
 ├─ id, key (unique), value, group (contact/social/donation)

activity_logs
 ├─ id, user_id, action, subject_type, subject_id, description, created_at
```

> `organization_members` menggunakan `parent_id` self-referencing agar hierarki jabatan (Ketua → Wakil → Divisi) bisa dirender otomatis sebagai tree/diagram — sesuai keputusan final di Section 13.

---

## 7. Alur Pengguna (User Flow)

**Pengunjung Publik:**
```
Landing di Beranda → Jelajahi menu (Tentang/Struktur/SOP/Berita/Galeri/Donasi/Kontak)
→ Tidak ada barrier login di mana pun
→ Bisa langsung lihat info rekening donasi atau isi form kontak
```

**Admin:**
```
/admin/login → Dashboard (ringkasan jumlah berita, galeri, aktivitas terakhir)
→ Pilih modul (Berita/Galeri/Struktur/Pengaturan)
→ CRUD via panel → Perubahan langsung tampil di frontend publik
→ Logout
```

---

## 8. Keamanan (Security)

| Area | Implementasi |
|---|---|
| **Autentikasi Admin** | Laravel built-in Auth (hashed password bcrypt/argon2), rate limiting percobaan login (`throttle` middleware) untuk cegah brute force |
| **Otorisasi** | Middleware `auth` — pastikan hanya admin yang bisa akses `/admin/*` (satu level akses, tanpa role terpisah) |
| **CSRF Protection** | Bawaan Laravel (`@csrf` di semua form) |
| **XSS Protection** | Blade auto-escape (`{{ }}`), sanitasi input rich text editor (whitelist tag HTML, strip script) |
| **SQL Injection** | Eloquent ORM / Query Builder (parameter binding otomatis) |
| **File Upload Validation** | Validasi mime-type, ekstensi, ukuran max, rename file (hindari path traversal & eksekusi file berbahaya), scan dasar (reject file `.php`, `.exe`, dll meski di-rename) |
| **HTTPS** | Wajib SSL (Let's Encrypt) di semua environment production |
| **Environment Secrets** | `.env` tidak masuk git, `APP_DEBUG=false` di production |
| **Session Security** | Session encrypted, cookie `HttpOnly` + `Secure` + `SameSite` |
| **Backup** | Backup database & storage terjadwal (harian/mingguan) — `spatie/laravel-backup` |
| **Admin URL** | Pertimbangkan custom path (bukan `/admin` default) untuk mengurangi automated scanning — opsional |
| **2FA Admin (opsional)** | Bisa ditambahkan manual (mis. `pragmarx/google2fa-laravel`) jika diinginkan tambahan lapisan keamanan |
| **Headers Keamanan** | CSP, X-Frame-Options, X-Content-Type-Options via middleware |

---

## 9. Desain & UI/UX

Mengacu pada `design.md` yang Anda berikan — token desain akan diimplementasikan sebagai berikut:

| Token | Nilai | Implementasi |
|---|---|---|
| Primary | `#ff6b00` | Warna CTA (tombol donasi, link aktif) |
| Accent | `#009c48` | Aksen sekunder (badge, ikon, hover state) — cocok dengan nuansa islami/hijau |
| Background | `#f0f0f0` | Latar halaman |
| Surface | `#ffffff` | Card, panel konten |
| Text | `#444444` | Teks utama |
| Heading Font | `El Messiri, sans-serif` | Judul halaman/section |
| Body Font | `sans-serif`, 13px/700 | Body text |
| Radius | sm 4px – xl 30px | Diterapkan konsisten di card, tombol, gambar |
| Shadow | card & elevated (soft shadow) | Card berita/galeri |
| Motion | fast 100ms, base 400ms, easing `ease-in` | Transisi hover, fade-in konten |
| Breakpoints | 769px / 782px / 901px | Dipetakan ke Tailwind custom breakpoints |

Token ini akan dikonversi menjadi `tailwind.config.js` custom theme (bukan nilai Tailwind default) agar konsisten dengan identitas visual yang sudah diriset dari referensi.

**Prinsip desain tambahan untuk konteks yayasan Islam:**
- Nuansa hangat & terpercaya (warna oranye + hijau selaras dengan referensi Muhammadiyah).
- Tipografi heading `El Messiri` mendukung karakter Arab-Latin yang umum dipakai lembaga Islam.
- Gambar anak-anak ditampilkan apa adanya tanpa proses blur wajah, sesuai keputusan klien (lihat Section 13, poin 6).

---

## 10. Responsive Design

- **Mobile-first approach**, breakpoint mengikuti `design.md`: mobile (<769px), tablet (769–900px), desktop (≥901px).
- Navigasi: hamburger menu di mobile, horizontal navbar di desktop.
- Galeri: grid 2 kolom mobile → 3–4 kolom desktop.
- Diagram struktur organisasi: pada mobile ditampilkan sebagai list bertingkat (accordion) atau scroll horizontal, di desktop sebagai tree/diagram penuh.
- Semua gambar responsive (`srcset`/lazy-load) untuk performa mobile.

---

## 11. Non-Functional Requirements

| Aspek | Target |
|---|---|
| **Performance** | Lighthouse score ≥ 85 (mobile), lazy-load gambar, caching (Laravel cache untuk halaman statis), image optimization otomatis |
| **SEO** | Meta tag dinamis, sitemap.xml, structured data (Organization schema untuk yayasan) |
| **Accessibility** | Kontras warna sesuai WCAG AA, alt text wajib untuk semua gambar (diinput admin) |
| **Maintainability** | Kode mengikuti Laravel best practice (Service/Repository pattern untuk logika kompleks, Form Request untuk validasi) |
| **Uptime** | Target 99% (tergantung pilihan hosting di Fase 5) |

---

## 12. Roadmap Fase (mengacu kesepakatan awal)

| Fase | Cakupan |
|---|---|
| Fase 1 | Desain & Perencanaan — **dokumen ini** |
| Fase 2 | Backend: setup Laravel, migration, model, custom admin panel, auth, business logic |
| Fase 3 | Frontend: Blade + Tailwind sesuai `design.md`, integrasi data dari backend |
| Fase 4 | Testing (functional, security, responsive), bug fixing |
| Fase 5 | Deployment (pilihan hosting, SSL, domain, backup strategy) |

---

## 13. Keputusan Proyek

### 13.1 Sudah Dikonfirmasi ✅

| # | Keputusan | Hasil |
|---|---|---|
| 1 | Donasi | **Statis/informasi saja** — tampilkan nomor rekening (& opsional QRIS), tanpa payment gateway/transaksi online |
| 2 | Struktur Organisasi | **Data-driven (Opsi B)** — diagram digenerate otomatis dari data pengurus di admin |
| 3 | Admin Panel | **Custom Blade Admin Panel** — dibangun manual, bukan pakai Filament/paket siap pakai |
| 4 | Beranda | **Hero Carousel 3 slide** dengan navigasi `<` `>`, teks judul/subjudul, dan CTA per slide — dikelola dari admin |
| 5 | Kontak Cepat | **Floating WhatsApp Popup** di semua halaman, mengarah ke `wa.me` dengan pesan default, nomor diatur di admin |
| 6 | Foto Anak di Galeri/Berita | **Tanpa blur** — foto ditampilkan apa adanya (tidak ada pemrosesan blur wajah otomatis maupun manual) |
| 7 | Multi-admin | **Tidak** — cukup 1 akun admin (pengurus utama), tanpa role Super Admin/Editor terpisah |
| 8 | Konten Hero Slider Awal | **Placeholder sementara** — 3 foto & teks dummy dipakai saat launch, nanti diganti klien sendiri lewat `/admin/hero-slider` |
| 9 | Navbar & Footer | **Dua logo berdampingan** di navbar & footer (lihat Section 4.1), footer 4 kolom (Identitas, Tautan Cepat, Hubungi Kami, Peta) + baris copyright |

---

*Dokumen ini adalah PRD Final Fase 1, telah disetujui oleh Project Manager. Siap dilanjutkan ke Fase 2: Backend Development.*
