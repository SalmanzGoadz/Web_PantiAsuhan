<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- Admin Account ---
        User::factory()->create([
            'name' => 'Admin Panti',
            'email' => 'admin@pantiasuhan.org',
            'password' => bcrypt('password'),
        ]);

        // --- Site Settings ---
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'Panti Asuhan Muhammadiyah Semarang', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Yayasan Kesejahteraan Sosial yang bergerak dalam bidang pengasuhan dan pembinaan anak yatim, piatu, yatim piatu, dan dhuafa.', 'group' => 'general'],

            // Contact
            ['key' => 'address', 'value' => 'Jl. Contoh No. 123, Semarang, Jawa Tengah 50133', 'group' => 'contact'],
            ['key' => 'phone', 'value' => '024-1234567', 'group' => 'contact'],
            ['key' => 'email', 'value' => 'info@pantiasuhan-muhammadiyah.or.id', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '6281234567890', 'group' => 'contact'],
            ['key' => 'whatsapp_message', 'value' => 'Assalamu\'alaikum, saya ingin bertanya tentang Panti Asuhan Muhammadiyah Semarang.', 'group' => 'contact'],
            ['key' => 'google_maps_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0!2d110.4!3d-7.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1', 'group' => 'contact'],

            // Social
            ['key' => 'instagram', 'value' => 'https://instagram.com/pantiasuhan_muhammadiyah_smg', 'group' => 'social'],
            ['key' => 'facebook', 'value' => 'https://facebook.com/pantiasuhan.muhammadiyah.semarang', 'group' => 'social'],
            ['key' => 'youtube', 'value' => '', 'group' => 'social'],
            ['key' => 'tiktok', 'value' => '', 'group' => 'social'],

            // Donation
            ['key' => 'bank_name', 'value' => 'Bank Syariah Indonesia (BSI)', 'group' => 'donation'],
            ['key' => 'bank_account_number', 'value' => '1234567890', 'group' => 'donation'],
            ['key' => 'bank_account_name', 'value' => 'Yayasan Panti Asuhan Muhammadiyah Semarang', 'group' => 'donation'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }

        // --- Pages (Static Content) ---
        Page::create([
            'slug' => 'tentang-kami',
            'title' => 'Tentang Kami',
            'content' => '<h2>Sejarah Panti Asuhan</h2><p>Panti Asuhan Muhammadiyah Semarang didirikan dengan tujuan mulia untuk memberikan pengasuhan, pendidikan, dan pembinaan bagi anak-anak yatim, piatu, yatim piatu, dan dhuafa. Berdiri sejak tahun XXXX, panti asuhan ini terus berkomitmen untuk mewujudkan generasi Islam yang mandiri, beriman, dan berakhlak mulia.</p><h2>Visi</h2><p>Menjadi lembaga pengasuhan anak yang profesional, amanah, dan berlandaskan nilai-nilai Islam Muhammadiyah.</p><h2>Misi</h2><ul><li>Memberikan pengasuhan yang layak dan penuh kasih sayang.</li><li>Menyelenggarakan pendidikan yang berkualitas.</li><li>Membina akhlak dan keimanan anak asuh.</li><li>Menyiapkan anak asuh menjadi pribadi yang mandiri dan bermanfaat bagi masyarakat.</li></ul>',
            'meta_title' => 'Tentang Kami — Panti Asuhan Muhammadiyah Semarang',
            'meta_description' => 'Sejarah, visi, dan misi Panti Asuhan Muhammadiyah Semarang.',
        ]);

        Page::create([
            'slug' => 'visi-misi',
            'title' => 'Visi & Misi',
            'content' => '<h2>Visi</h2><p>Menjadi lembaga pengasuhan anak yang profesional, amanah, dan berlandaskan nilai-nilai Islam Muhammadiyah untuk mewujudkan generasi yang mandiri, beriman, dan berakhlak mulia.</p><h2>Misi</h2><ol><li>Memberikan pengasuhan yang layak dan penuh kasih sayang kepada anak yatim, piatu, dan dhuafa.</li><li>Menyelenggarakan pendidikan formal dan non-formal yang berkualitas.</li><li>Membina akhlak, keimanan, dan ketaqwaan anak asuh sesuai ajaran Islam.</li><li>Menyiapkan anak asuh menjadi pribadi yang mandiri, terampil, dan bermanfaat bagi masyarakat.</li><li>Membangun kerjasama dengan berbagai pihak demi kesejahteraan anak asuh.</li></ol>',
            'meta_title' => 'Visi & Misi — Panti Asuhan Muhammadiyah Semarang',
            'meta_description' => 'Visi dan misi Panti Asuhan Muhammadiyah Semarang.',
        ]);

        Page::create([
            'slug' => 'sop-pengasuhan',
            'title' => 'SOP Pengasuhan Anak',
            'content' => '<h2>Standar Operasional Prosedur Pengasuhan</h2><p>Panti Asuhan Muhammadiyah Semarang menerapkan SOP pengasuhan yang terstandar untuk memastikan setiap anak asuh mendapatkan perhatian, pendidikan, dan pembinaan yang optimal.</p><h3>1. Penerimaan Anak Asuh</h3><p>Proses penerimaan anak asuh dilakukan melalui tahapan seleksi administrasi, verifikasi data, dan wawancara dengan keluarga/wali.</p><h3>2. Pembinaan Harian</h3><p>Setiap hari anak asuh mengikuti kegiatan yang terjadwal meliputi ibadah, pendidikan, kegiatan ekstra, dan waktu istirahat.</p><h3>3. Pendidikan</h3><p>Anak asuh didukung penuh untuk menempuh pendidikan formal dari tingkat SD hingga perguruan tinggi.</p>',
            'meta_title' => 'SOP Pengasuhan — Panti Asuhan Muhammadiyah Semarang',
            'meta_description' => 'Standar Operasional Prosedur pengasuhan anak di Panti Asuhan Muhammadiyah Semarang.',
        ]);

        // --- Hero Slides (3 placeholder slides) ---
        HeroSlide::create([
            'image' => '',
            'title' => 'Selamat Datang di Panti Asuhan Muhammadiyah',
            'subtitle' => 'Membangun generasi Islam yang mandiri, beriman, dan berakhlak mulia',
            'cta_text' => 'Salurkan Donasi',
            'cta_link' => '/donasi',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'image' => '',
            'title' => 'Bersama Kita Peduli',
            'subtitle' => 'Bantu anak-anak yatim dan dhuafa meraih masa depan yang lebih cerah',
            'cta_text' => 'Tentang Kami',
            'cta_link' => '/tentang-kami',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'image' => '',
            'title' => 'Program Kegiatan Kami',
            'subtitle' => 'Pendidikan, pembinaan akhlak, dan pengembangan keterampilan anak asuh',
            'cta_text' => 'Lihat Galeri',
            'cta_link' => '/galeri',
            'sort_order' => 3,
            'is_active' => true,
        ]);
    }
}
