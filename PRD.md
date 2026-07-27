# PRD (Product Requirements Document)
## Website Panti Asuhan — Yayasan Islam

| | |
|---|---|
| **Versi** | 1.2 (Update Fitur Transparansi Keuangan) |
| **Status** | Disetujui — diimplementasi |
| **Tech Stack Utama** | Laravel |

---

## 1. Ringkasan Proyek

Website profil & informasi resmi untuk sebuah Panti Asuhan di bawah Yayasan Islam. Website bersifat **read-only untuk publik** (tanpa registrasi/login pengguna) dan dikelola melalui **panel admin (CMS)** oleh pengurus panti untuk mengelola konten: berita, galeri kegiatan, struktur organisasi, dan transparansi keuangan (Buku Kas).

Tujuan utama:
- Media informasi resmi & transparansi yayasan kepada masyarakat/donatur.
- Memudahkan pengurus mengupdate konten tanpa bantuan developer (self-service CMS).
- Membangun kepercayaan publik melalui transparansi struktur organisasi, kegiatan, dan laporan keuangan (Buku Kas).

---

## 2. Target Pengguna

| Role | Akses | Login? |
|---|---|---|
| **Pengunjung Publik** | Lihat semua halaman informasi (read-only) | ❌ Tidak ada login |
| **Admin/Pengurus Panti** | CRUD Berita, Galeri, Struktur Organisasi, Buku Kas, Pengaturan Situs | ✅ Login wajib |

> Catatan: Tidak ada sistem akun untuk pengunjung. Tidak ada fitur komentar/interaksi user yang butuh identitas, sesuai instruksi.

---

## 3. Tech Stack

| Layer | Teknologi | Alasan |
|---|---|---|
| Backend Framework | **Laravel 11 (PHP 8.3+)** | Sesuai keputusan Anda |
| Admin Panel/CMS | **Custom Admin Panel (Blade + Laravel)** ✅ *dikonfirmasi* | Dibangun manual di atas Laravel — controller, route, view khusus admin. Lebih fleksibel untuk kebutuhan spesifik (buku kas dinamis, org chart dinamis, WA popup) |
| Frontend Publik | **Blade + Tailwind CSS** | Native Laravel, ringan, mudah dipetakan ke design tokens dari `design.md` Anda |
| Database | **MySQL 8** | Standar Laravel, kompatibel luas dengan hosting |
| Media Storage | Local disk (`storage/app/public`) untuk awal | Efisiensi biaya di tahap awal |
| Image Processing | **Intervention/Image** atau `spatie/laravel-media-library` | Resize/optimize otomatis saat upload (thumbnail, WebP) |
| Search Engine (opsional) | Laravel Scout + database driver | Jika berita/galeri jumlahnya banyak dan butuh pencarian |
| Diagram Struktur Organisasi | **Data-driven (Opsi B)** ✅ *dikonfirmasi* | Dirender sebagai chart/tree dinamis dari database |
| Hosting | VPS (Ubuntu 22.04 + Nginx) atau shared hosting | Tergantung budget klien |
| Version Control | Git + repository privat | Standar |

---

## 4. Sitemap — Halaman Publik

```
/                       → Beranda (Hero Carousel, ringkasan visi-misi, berita terbaru, CTA donasi)
/tentang-kami           → Sejarah, Visi & Misi Yayasan
/struktur-organisasi    → Diagram struktur pengurus panti
/sop-pengasuhan         → SOP Pengasuhan Anak
/berita                 → Daftar berita (paginated)
/berita/{slug}          → Detail berita
/galeri                 → Daftar galeri kegiatan (grid/album)
/galeri/{slug}          → Detail album galeri (lightbox)
/donasi                 → Informasi donasi & Transparansi Keuangan (Buku Kas, Daftar Donatur, RAB)
/kontak                 → Form kontak, alamat, peta, sosial media

[Komponen Global — tampil di semua halaman]
Floating WhatsApp Button → Popup kontak cepat ke pengurus
```

Admin (terpisah, tidak terindeks search engine):
```
/admin/login
/admin/dashboard        (Ringkasan data, termasuk Saldo Keuangan & Quick Actions)
/admin/berita           (CRUD)
/admin/galeri           (CRUD)
/admin/struktur         (CRUD anggota/jabatan pengurus)
/admin/hero-slider      (CRUD slide beranda)
/admin/buku-kas         (CRUD Donatur & Pengeluaran/RAB dengan toggle status)
/admin/pengaturan       (alamat, kontak, sosmed, rekening donasi, logo)
```

---

## 4.1 Komponen Layout Global (Navbar & Footer)

### Navbar (Header)
- **Dua logo berdampingan** di sisi kiri navbar: logo utama yayasan + logo kedua (dari `/admin/pengaturan`).
- Menu navigasi horizontal.
- Tombol CTA "Donasi Sekarang" menggunakan warna primary `#ff6b00`.

### Footer
1. **Kolom Identitas** — dua logo, nama panti, deskripsi singkat yayasan, ikon sosial media.
2. **Tautan Cepat** — daftar link internal.
3. **Hubungi Kami** — alamat, nomor telepon, email.
4. **Peta Lokasi** — embed Google Maps di atas footer.

---

## 5. Modul & Fitur

### 5.1 Modul Publik
- **Hero Carousel (Beranda)** — slider gambar, judul, CTA (admin-managed).
- **Beranda** — nilai/value, berita terbaru, galeri terbaru.
- **Tentang Kami** — konten statis (WYSIWYG editor).
- **Struktur Organisasi** — diagram dinamis (tree/chart).
- **SOP Pengasuhan Anak** — konten statis.
- **Berita & Galeri** — listing dan detail (dengan cover, rich text, pagination).
- **Donasi & Transparansi Keuangan (Buku Kas)** — Menampilkan nomor rekening/QRIS donasi, serta bagian transparansi keuangan. Transparansi meliputi **kalkulasi saldo dinamis** (Total Donasi - Pengeluaran Terlaksana), **daftar donatur terbaru** (opsi Hamba Allah jika anonim), dan **daftar RAB / pengeluaran** dengan lencana status (Rencana/Terlaksana).
- **Floating WhatsApp Popup** — popup chat ke admin, nomor dikelola dari `/admin/pengaturan`.
- **Kontak & SEO** — form alamat, peta, Meta tag, Open Graph.

### 5.2 Modul Admin (CMS) — Custom Admin Panel
- **Autentikasi Admin** — login (Laravel Auth).
- **Dashboard** — Ringkasan data (Total Berita, Galeri, Anggota, Saldo Keuangan dinamis).
- **Manajemen Berita, Galeri, Hero Slider, Struktur, Pengaturan** — fitur CRUD lengkap.
- **Manajemen Buku Kas (Transparansi Keuangan)** — 
    - **Tab Donatur**: Input nama, jumlah, tanggal, dan flag Anonim (Hamba Allah).
    - **Tab RAB/Pengeluaran**: Input judul kegiatan, jumlah, deskripsi, tanggal, dan status (Rencana/Terlaksana). Dilengkapi dengan **Toggle Cepat** untuk mengubah status dengan sekali klik.
- **Activity Log** — mencatat aktivitas (CRUD dan ubah status) oleh admin (audit trail dasar).

---

## 6. Struktur Database (Terbaru)

```
users (admin)
 ├─ id, name, email, password, created_at...

news (berita)
 ├─ id, title, slug, excerpt, content, cover_image, status, published_at...

hero_slides (slider beranda)
 ├─ id, image, title, subtitle, cta_text, cta_link, sort_order, is_active...

galleries & gallery_items (album & foto)
 ├─ ... (struktur standar album galeri)

organization_members (struktur organisasi)
 ├─ id, name, position, photo, parent_id, sort_order, level, is_active

pages (konten statis)
 ├─ id, slug, title, content, updated_at

site_settings (pengaturan)
 ├─ id, key, value, group

activity_logs (audit)
 ├─ id, user_id, action, subject_type, subject_id, description, created_at

donors (donatur buku kas)
 ├─ id, name, amount, date, is_anonymous (boolean), created_at, updated_at

expenses (pengeluaran / RAB buku kas)
 ├─ id, title, amount, description, date, status (enum: rencana, terlaksana), created_at, updated_at
```

---

## 7. Alur Pengguna (User Flow)

**Pengunjung Publik:**
```
Landing di Beranda → Jelajahi menu
→ Halaman Donasi: Lihat info transfer & Transparansi Keuangan (Saldo, Donatur, RAB)
→ Tidak ada barrier login
```

**Admin:**
```
/admin/login → Dashboard (lihat Saldo Keuangan)
→ Pilih modul Buku Kas → Tab Donatur (catat donasi) / Tab Pengeluaran (tambah RAB / toggle status jadi Terlaksana)
→ Logout
```

---

## 8. Keamanan (Security)

- Autentikasi Laravel (bcrypt, throttle).
- Akses ke `/admin/*` dijaga oleh middleware `auth`.
- CSRF Protection, XSS Protection (sanitasi editor), SQL Injection (Eloquent/Bindings).
- Upload file tervalidasi.

---

## 9. Desain & UI/UX

Mengacu pada `design.md`:
- **Primary**: `#ff6b00`, **Accent**: `#009c48` (hijau islami).
- **Background**: `#f0f0f0`, **Surface**: `#ffffff`.
- **Heading Font**: `El Messiri`, **Body**: `sans-serif` (13px/700).
- Desain *Buku Kas* menggunakan UI cards untuk visualisasi saldo, tabel rapi dengan lencana hijau/kuning untuk status pengeluaran.
- Tanpa fitur blur wajah otomatis.

---

## 10. Responsive Design

- Mobile-first approach dengan breakpoint kustom Tailwind.
- Navigasi hamburger menu, grid galeri responsif.
- Tabel Buku Kas dibungkus `overflow-x-auto` agar bisa di-scroll horizontal di perangkat mobile.

---

## 11. Keputusan Proyek Terkini ✅

| # | Keputusan | Keterangan |
|---|---|---|
| 1 | Donasi & Buku Kas | **Tanpa sistem saldo statis**. Total saldo dikalkulasi otomatis dari `Total Donasi - Pengeluaran(Terlaksana)`. Fitur payment gateway ditiadakan (transfer manual bank/QRIS). |
| 2 | Privasi Donatur | Terdapat checkbox `is_anonymous` di admin. Jika dicentang, nama di frontend otomatis menjadi "Hamba Allah". |
| 3 | Admin Panel | Menggunakan custom blade admin panel, menggunakan Vanilla JS untuk tab interface (Buku Kas) tanpa framework tambahan seperti Alpine.js. |
| 4 | Struktur & Hero | Data-driven dengan manajemen lewat CMS secara mandiri. |
| 5 | Multi-admin | Cukup 1 akun admin utama. |

---

*Dokumen ini adalah PRD versi terbaru yang telah disinkronkan sepenuhnya dengan kondisi codebase Laravel saat ini.*
