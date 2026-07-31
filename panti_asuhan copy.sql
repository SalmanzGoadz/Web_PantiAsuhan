-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for panti_asuhan
CREATE DATABASE IF NOT EXISTS `panti_asuhan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `panti_asuhan`;

-- Dumping structure for table panti_asuhan.activity_logs
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_subject_type_subject_id_index` (`subject_type`,`subject_id`),
  KEY `activity_logs_user_id_index` (`user_id`),
  KEY `activity_logs_created_at_index` (`created_at`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.activity_logs: ~71 rows (approximately)
INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `subject_type`, `subject_id`, `description`, `created_at`, `updated_at`) VALUES
	(1, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-22 07:17:17', NULL),
	(2, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-22 08:05:13', NULL),
	(3, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan umum situs', '2026-07-22 08:09:19', NULL),
	(4, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan umum situs', '2026-07-22 08:09:23', NULL),
	(5, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan umum situs', '2026-07-22 08:11:22', NULL),
	(6, 1, 'updated', 'App\\Models\\HeroSlide', 1, 'Mengubah hero slide: Selamat Datang di Panti Asuhan Muhammadiyah', '2026-07-22 08:35:48', NULL),
	(7, 1, 'updated', 'App\\Models\\HeroSlide', 2, 'Mengubah hero slide: Bersama Kita Peduli', '2026-07-22 08:35:59', NULL),
	(8, 1, 'updated', 'App\\Models\\HeroSlide', 3, 'Mengubah hero slide: Program Kegiatan Kami', '2026-07-22 08:36:12', NULL),
	(9, 1, 'created', 'App\\Models\\Gallery', 1, 'Membuat album galeri: Rapat', '2026-07-22 08:37:32', NULL),
	(10, 1, 'deleted', 'App\\Models\\Gallery', 1, 'Menghapus album galeri: Rapat', '2026-07-22 08:38:20', NULL),
	(11, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-22 21:53:09', NULL),
	(12, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan kontak', '2026-07-22 21:54:08', NULL),
	(13, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan kontak', '2026-07-22 21:54:41', NULL),
	(14, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan kontak', '2026-07-22 21:55:23', NULL),
	(15, 1, 'created', 'App\\Models\\OrganizationMember', 1, 'Menambah anggota pengurus: Dr. K.H. Fachur Rozi,M.Ag (Pimpinan Daerah Muhammadiyah(PDM)Semarang)', '2026-07-22 21:59:17', NULL),
	(16, 1, 'created', 'App\\Models\\OrganizationMember', 2, 'Menambah anggota pengurus: dr. Sarwoko Oetomo,MMR., FISQua (Majelis Pembinaan Kesejahteraan Sosial(MPKS) PDM Kota Semarang)', '2026-07-22 22:01:07', NULL),
	(17, 1, 'created', 'App\\Models\\OrganizationMember', 3, 'Menambah anggota pengurus: H. Muh Syamsuddin, S.sos., M.M (Ketua)', '2026-07-22 22:02:39', NULL),
	(18, 1, 'updated', 'App\\Models\\OrganizationMember', 2, 'Mengubah anggota pengurus: dr. Sarwoko Oetomo,MMR., FISQua (Majelis Pembinaan Kesejahteraan Sosial(MPKS) PDM Kota Semarang)', '2026-07-22 22:03:35', NULL),
	(19, 1, 'updated', 'App\\Models\\OrganizationMember', 3, 'Mengubah anggota pengurus: H. Muh Syamsuddin, S.sos., M.M (Ketua)', '2026-07-22 22:58:38', NULL),
	(20, 1, 'created', 'App\\Models\\OrganizationMember', 4, 'Menambah anggota pengurus: Muh Natsir Noor effendi, S.H (Sekretaris)', '2026-07-22 22:59:44', NULL),
	(21, 1, 'updated', 'App\\Models\\OrganizationMember', 4, 'Mengubah anggota pengurus: Muh Natsir Noor effendi, S.H (Sekretaris)', '2026-07-22 23:00:13', NULL),
	(22, 1, 'created', 'App\\Models\\OrganizationMember', 5, 'Menambah anggota pengurus: Santoso, S.E (Bendahara)', '2026-07-22 23:01:04', NULL),
	(23, 1, 'created', 'App\\Models\\OrganizationMember', 6, 'Menambah anggota pengurus: Fitri Fidia Lestari (Staf Pengurus)', '2026-07-22 23:02:24', NULL),
	(24, 1, 'updated', 'App\\Models\\OrganizationMember', 6, 'Mengubah anggota pengurus: Fitri Fidia Lestari (Staf Pengurus)', '2026-07-22 23:03:31', NULL),
	(25, 1, 'created', 'App\\Models\\OrganizationMember', 7, 'Menambah anggota pengurus: Ahmad Dahlan (Ketua Panti)', '2026-07-22 23:05:08', NULL),
	(26, 1, 'updated', 'App\\Models\\OrganizationMember', 7, 'Mengubah anggota pengurus: Ahmad Dahlan (Ketua Panti)', '2026-07-22 23:05:39', NULL),
	(27, 1, 'updated', 'App\\Models\\OrganizationMember', 7, 'Mengubah anggota pengurus: Ahmad Dahlan (Kepala Panti)', '2026-07-22 23:10:20', NULL),
	(28, 1, 'updated', 'App\\Models\\OrganizationMember', 6, 'Mengubah anggota pengurus: Fitri Fidia Lestari (Staf Pengurus)', '2026-07-22 23:10:45', NULL),
	(29, 1, 'updated', 'App\\Models\\OrganizationMember', 7, 'Mengubah anggota pengurus: Ahmad Dahlan (Kepala Panti)', '2026-07-22 23:10:56', NULL),
	(30, 1, 'created', 'App\\Models\\OrganizationMember', 8, 'Menambah anggota pengurus: Dimas Khijri Saputra, M.Pd (Staf Pendidikan)', '2026-07-22 23:12:52', NULL),
	(31, 1, 'created', 'App\\Models\\OrganizationMember', 9, 'Menambah anggota pengurus: Wisnu (Staf Media Informasi & Publikasi)', '2026-07-22 23:13:30', NULL),
	(32, 1, 'created', 'App\\Models\\OrganizationMember', 10, 'Menambah anggota pengurus: Siswanti (Staf Dapur / Juru Masak)', '2026-07-22 23:14:23', NULL),
	(33, 1, 'created', 'App\\Models\\OrganizationMember', 11, 'Menambah anggota pengurus: Muhammad Riski Isnaedi (Staf Tata Usaha(TU))', '2026-07-22 23:15:08', NULL),
	(34, 1, 'created', 'App\\Models\\OrganizationMember', 12, 'Menambah anggota pengurus: Jasmari (Staf Kedisiplinan,Kebersihan,dan Keamanan)', '2026-07-22 23:16:00', NULL),
	(35, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan kontak', '2026-07-22 23:27:45', NULL),
	(36, 1, 'updated', 'App\\Models\\Page', 1, 'Memperbarui halaman: Tentang Kami', '2026-07-22 23:41:17', NULL),
	(37, 1, 'updated', 'App\\Models\\Page', 2, 'Memperbarui halaman: Visi & Misi', '2026-07-22 23:46:35', NULL),
	(38, 1, 'updated', 'App\\Models\\Page', 3, 'Memperbarui halaman: SOP Pengasuhan Anak', '2026-07-22 23:50:24', NULL),
	(39, 1, 'updated', 'App\\Models\\Page', 3, 'Memperbarui halaman: SOP Pengasuhan Anak', '2026-07-22 23:53:38', NULL),
	(40, 1, 'updated', 'App\\Models\\Page', 3, 'Memperbarui halaman: SOP Pengasuhan Anak', '2026-07-22 23:54:07', NULL),
	(41, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan sosial media', '2026-07-22 23:57:13', NULL),
	(42, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan kontak', '2026-07-22 23:58:42', NULL),
	(43, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-23 01:25:29', NULL),
	(44, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan kontak', '2026-07-23 01:25:57', NULL),
	(45, 1, 'updated', NULL, NULL, 'Memperbarui pengaturan kontak', '2026-07-23 01:26:52', NULL),
	(46, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-24 07:39:20', NULL),
	(47, 1, 'logout', NULL, NULL, 'Admin logged out', '2026-07-24 07:40:02', NULL),
	(48, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-25 06:14:55', NULL),
	(49, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-25 06:54:32', NULL),
	(50, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-25 07:03:02', NULL),
	(51, 1, 'logout', NULL, NULL, 'Admin logged out', '2026-07-25 07:05:08', NULL),
	(52, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-25 07:08:16', NULL),
	(53, 1, 'created', 'App\\Models\\News', 1, 'Membuat berita: Kontingen LKSA Panti Asuhan Muhammadiyah Semarang Raih Juara 1 Musikalisasi Puisi pada Jambore Ke-4 MMC-LKSA Muhammadiyah & Aisyiyah Jawa Tengah', '2026-07-25 07:20:07', NULL),
	(54, 1, 'updated', 'App\\Models\\News', 1, 'Mengubah berita: Kontingen LKSA Panti Asuhan Muhammadiyah Semarang Raih Juara 1 Musikalisasi Puisi pada Jambore Ke-4 MMC-LKSA Muhammadiyah & Aisyiyah Jawa Tengah', '2026-07-25 07:20:34', NULL),
	(55, 1, 'updated', 'App\\Models\\News', 1, 'Mengubah berita: Kontingen LKSA Panti Asuhan Muhammadiyah Semarang Raih Juara 1 Musikalisasi Puisi pada Jambore Ke-4 MMC-LKSA Muhammadiyah & Aisyiyah Jawa Tengah', '2026-07-25 07:23:57', NULL),
	(56, 1, 'created', 'App\\Models\\Gallery', 2, 'Membuat album galeri: Kebumen', '2026-07-25 07:25:34', NULL),
	(57, 1, 'deleted', 'App\\Models\\Gallery', 2, 'Menghapus album galeri: Kebumen', '2026-07-25 07:28:01', NULL),
	(58, 1, 'created', 'App\\Models\\Gallery', 3, 'Membuat album galeri: Kebumen', '2026-07-25 07:29:05', NULL),
	(59, 1, 'updated', 'App\\Models\\News', 1, 'Mengubah berita: Kontingen LKSA Panti Asuhan Muhammadiyah Semarang Raih Juara 1 Musikalisasi Puisi pada Jambore Ke-4 MMC-LKSA Muhammadiyah & Aisyiyah Jawa Tengah', '2026-07-25 07:32:46', NULL),
	(60, 1, 'updated', 'App\\Models\\News', 1, 'Mengubah berita: Kontingen LKSA Panti Asuhan Muhammadiyah Semarang Raih Juara 1 Musikalisasi Puisi pada Jambore Ke-4 MMC-LKSA Muhammadiyah & Aisyiyah Jawa Tengah', '2026-07-25 14:38:10', NULL),
	(61, 1, 'created', 'App\\Models\\News', 2, 'Membuat berita: test', '2026-07-25 15:17:41', NULL),
	(62, 1, 'updated', 'App\\Models\\News', 2, 'Mengubah berita: test', '2026-07-25 15:18:06', NULL),
	(63, 1, 'deleted', 'App\\Models\\News', 2, 'Menghapus berita: test', '2026-07-25 15:18:24', NULL),
	(64, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-27 20:34:27', NULL),
	(65, 1, 'created', 'App\\Models\\Donor', 1, 'Menambah donatur: Admin testing — Rp 100', '2026-07-27 20:35:45', NULL),
	(66, 1, 'updated', 'App\\Models\\Donor', 1, 'Mengubah donatur: Admin testing', '2026-07-27 20:36:05', NULL),
	(67, 1, 'created', 'App\\Models\\Expense', 1, 'Menambah pengeluaran: test(beras habis) — Rp 50.000', '2026-07-27 20:36:30', NULL),
	(68, 1, 'updated', 'App\\Models\\Expense', 1, 'Mengubah pengeluaran: test(beras habis)', '2026-07-27 20:37:01', NULL),
	(69, 1, 'deleted', 'App\\Models\\Donor', 1, 'Menghapus donatur: Admin testing', '2026-07-27 20:37:24', NULL),
	(70, 1, 'deleted', 'App\\Models\\Expense', 1, 'Menghapus pengeluaran: test(beras habis)', '2026-07-27 20:37:34', NULL),
	(71, 1, 'created', 'App\\Models\\News', 3, 'Membuat berita: test', '2026-07-27 20:38:39', NULL),
	(72, 1, 'deleted', 'App\\Models\\News', 3, 'Menghapus berita: test', '2026-07-27 20:38:45', NULL),
	(73, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-28 16:56:04', NULL),
	(74, 1, 'created', 'App\\Models\\OrganizationMember', 13, 'Menambah anggota pengurus: mas alan (asisten TU)', '2026-07-28 17:00:07', NULL),
	(75, 1, 'updated', 'App\\Models\\OrganizationMember', 13, 'Mengubah anggota pengurus: mas alan (asisten TU)', '2026-07-28 17:02:09', NULL),
	(76, 1, 'updated', 'App\\Models\\OrganizationMember', 13, 'Mengubah anggota pengurus: mas alan (asisten TU)', '2026-07-28 17:02:33', NULL),
	(77, 1, 'updated', 'App\\Models\\OrganizationMember', 13, 'Mengubah anggota pengurus: mas alan (asisten TU)', '2026-07-28 17:03:16', NULL),
	(78, 1, 'updated', 'App\\Models\\OrganizationMember', 13, 'Mengubah anggota pengurus: mas alan (Staff Asisten TU)', '2026-07-28 17:10:31', NULL),
	(79, 1, 'created', 'App\\Models\\Expense', 2, 'Menambah pengeluaran: butuh beras 1kg — Rp 50.000', '2026-07-28 17:12:43', NULL),
	(80, 1, 'created', 'App\\Models\\Donor', 2, 'Menambah donatur: mas alan — Rp 100.000', '2026-07-28 17:13:30', NULL),
	(81, 1, 'updated', 'App\\Models\\Expense', 2, 'Mengubah pengeluaran: butuh beras 1kg', '2026-07-28 17:13:58', NULL),
	(82, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-29 09:18:00', NULL),
	(83, 1, 'deleted', 'App\\Models\\Gallery', 3, 'Menghapus album galeri: Kebumen', '2026-07-29 09:18:26', NULL),
	(84, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-29 15:20:46', NULL),
	(85, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-30 01:14:58', NULL),
	(86, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-30 03:04:37', NULL),
	(87, 1, 'logout', NULL, NULL, 'Admin logged out', '2026-07-30 03:05:02', NULL),
	(88, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-30 20:51:07', NULL),
	(89, 1, 'updated', 'App\\Models\\Donor', 3, 'Memvalidasi donasi dari: Salman.test — Rp 10.000', '2026-07-30 20:53:21', NULL),
	(90, 1, 'logout', NULL, NULL, 'Admin logged out', '2026-07-30 21:04:58', NULL),
	(91, 1, 'login', NULL, NULL, 'Admin logged in', '2026-07-30 21:12:00', NULL),
	(92, 1, 'updated', 'App\\Models\\Donor', 3, 'Mengubah donatur: Salman.test', '2026-07-30 21:13:40', NULL);

-- Dumping structure for table panti_asuhan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.cache: ~17 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('panti-asuhan-muhammadiyah-semarang-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:2;', 1785455665),
	('panti-asuhan-muhammadiyah-semarang-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1785455665;', 1785455665),
	('panti-asuhan-muhammadiyah-semarang-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1785445940),
	('panti-asuhan-muhammadiyah-semarang-cache-da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1785445940;', 1785445940),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_address', 's:96:"Jl. Giri Mukti Bar. II No.19, Tlogosari Kulon, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50196";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_email', 's:28:"mcc.lksa.pamuh.smg@gmail.com";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_facebook', 'N;', 1785459465),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_google_maps_embed', 's:410:"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.179454393031!2d110.46018437442082!3d-6.9881316684348915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708cdb5955f7fd%3A0x2dd118c3e56d1f3a!2sPanti%20Asuhan%20Muhammadiyah!5e0!3m2!1sid!2sid!4v1784782466727!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_instagram', 's:44:"https://www.instagram.com/mcc.lksa.pamuh.smg";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_logo_primary', 's:50:"logos/7iHnYnFEJ462l8KXVOhAWMaGt5dVUTXJX7nmWnMA.jpg";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_logo_secondary', 's:50:"logos/B154pKXxW9vr1qqcJM7TrWSagf9jnKGRC7blboAc.jpg";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_phone', 's:13:"6285165810824";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_site_description', 's:124:"Yayasan Kesejahteraan Sosial yang bergerak dalam bidang pengasuhan dan pembinaan anak yatim, piatu, yatim piatu, dan dhuafa.";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_site_name', 's:39:"LKSA Panti Asuhan Muhammadiyah Semarang";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_whatsapp_message', 's:81:"Assalamu\'alaikum, saya ingin bertanya tentang Panti Asuhan Muhammadiyah Semarang.";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_whatsapp_number', 's:13:"6285165810824";', 1785459077),
	('panti-asuhan-muhammadiyah-semarang-cache-site_setting_youtube', 's:43:"https://www.youtube.com/@MCC-LKSA_Pamuh_Smg";', 1785459077);

-- Dumping structure for table panti_asuhan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.cache_locks: ~0 rows (approximately)

-- Dumping structure for table panti_asuhan.donors
CREATE TABLE IF NOT EXISTS `donors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `date` date NOT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `proof_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('menunggu','tervalidasi') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `prayer` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `donors_user_id_foreign` (`user_id`),
  CONSTRAINT `donors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.donors: ~1 rows (approximately)
INSERT INTO `donors` (`id`, `user_id`, `name`, `amount`, `date`, `is_anonymous`, `proof_image`, `status`, `prayer`, `created_at`, `updated_at`) VALUES
	(2, NULL, 'mas alan', 100000.00, '2026-07-29', 1, NULL, 'tervalidasi', NULL, '2026-07-28 17:13:30', '2026-07-28 17:13:30'),
	(3, 2, 'Salman.test', 10000.00, '2026-07-31', 0, 'proof_images/mPVx0oS2HFwn4b21uDiAEt99SLpCgRNBU3Y5oc0d.jpg', 'tervalidasi', 'doakan saya agar sukses', '2026-07-30 20:50:26', '2026-07-30 20:53:21');

-- Dumping structure for table panti_asuhan.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `status` enum('rencana','terlaksana') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'rencana',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.expenses: ~0 rows (approximately)
INSERT INTO `expenses` (`id`, `title`, `amount`, `description`, `date`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'butuh beras 1kg', 50000.00, NULL, '2026-07-29', 'terlaksana', '2026-07-28 17:12:43', '2026-07-28 17:13:58');

-- Dumping structure for table panti_asuhan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table panti_asuhan.galleries
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `galleries_slug_unique` (`slug`),
  KEY `galleries_published_at_index` (`published_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.galleries: ~0 rows (approximately)

-- Dumping structure for table panti_asuhan.gallery_items
CREATE TABLE IF NOT EXISTS `gallery_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gallery_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_items_gallery_id_foreign` (`gallery_id`),
  KEY `gallery_items_sort_order_index` (`sort_order`),
  CONSTRAINT `gallery_items_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.gallery_items: ~0 rows (approximately)

-- Dumping structure for table panti_asuhan.hero_slides
CREATE TABLE IF NOT EXISTS `hero_slides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cta_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hero_slides_is_active_index` (`is_active`),
  KEY `hero_slides_sort_order_index` (`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.hero_slides: ~3 rows (approximately)
INSERT INTO `hero_slides` (`id`, `image`, `title`, `subtitle`, `cta_text`, `cta_link`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'hero-slides/Eqas3FEpIH4at1KrNdvLE1GAnCHck1znXrEVuVtc.jpg', 'Selamat Datang di Panti Asuhan Muhammadiyah', 'Membangun generasi Islam yang mandiri, beriman, dan berakhlak mulia', 'Salurkan Donasi', '/donasi', 1, 1, '2026-07-22 07:09:19', '2026-07-22 08:35:48'),
	(2, 'hero-slides/bQj993XQJscNsswbMoUCnLWouqTWTR9yAlCuik7q.jpg', 'Bersama Kita Peduli', 'Bantu anak-anak yatim dan dhuafa meraih masa depan yang lebih cerah', 'Tentang Kami', '/tentang-kami', 2, 1, '2026-07-22 07:09:19', '2026-07-22 08:35:59'),
	(3, 'hero-slides/O4FJVN9t3cVU3HBAtRCTUjkeWrKj46iSSiwZy8x6.jpg', 'Program Kegiatan Kami', 'Pendidikan, pembinaan akhlak, dan pengembangan keterampilan anak asuh', 'Lihat Galeri', '/galeri', 3, 1, '2026-07-22 07:09:19', '2026-07-22 08:36:12');

-- Dumping structure for table panti_asuhan.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.jobs: ~0 rows (approximately)

-- Dumping structure for table panti_asuhan.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.job_batches: ~0 rows (approximately)

-- Dumping structure for table panti_asuhan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_07_22_000001_create_news_table', 1),
	(5, '2026_07_22_000002_create_hero_slides_table', 1),
	(6, '2026_07_22_000003_create_galleries_table', 1),
	(7, '2026_07_22_000004_create_gallery_items_table', 1),
	(8, '2026_07_22_000005_create_organization_members_table', 1),
	(9, '2026_07_22_000006_create_pages_table', 1),
	(10, '2026_07_22_000007_create_site_settings_table', 1),
	(11, '2026_07_22_000008_create_activity_logs_table', 1),
	(12, '2026_07_28_000001_create_donors_table', 2),
	(13, '2026_07_28_000002_create_expenses_table', 2),
	(14, '2026_07_30_000001_add_role_to_users_table', 3),
	(15, '2026_07_30_000002_add_interactive_columns_to_donors_table', 3);

-- Dumping structure for table panti_asuhan.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `author_id` bigint unsigned NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `news_slug_unique` (`slug`),
  KEY `news_author_id_foreign` (`author_id`),
  KEY `news_status_index` (`status`),
  KEY `news_published_at_index` (`published_at`),
  CONSTRAINT `news_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.news: ~1 rows (approximately)
INSERT INTO `news` (`id`, `title`, `slug`, `excerpt`, `content`, `cover_image`, `status`, `published_at`, `author_id`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
	(1, 'Kontingen LKSA Panti Asuhan Muhammadiyah Semarang Raih Juara 1 Musikalisasi Puisi pada Jambore Ke-4 MMC-LKSA Muhammadiyah & Aisyiyah Jawa Tengah', 'kontingen-lksa-panti-asuhan-muhammadiyah-semarang-raih-juara-1-musikalisasi-puisi-pada-jambore-ke-4-mmc-lksa-muhammadiyah-aisyiyah-jawa-tengah', 'Selamat kepada seluruh kontingen LKSA Panti Asuhan Muhammadiyah Semarang atas raihan Juara 1 Musikalisasi Puisi. Teruslah berkarya, menginspirasi, dan membawa nama baik persyarikatan Muhammadiyah.', '<p><img src="WKW" alt="" width="100" height="200"></p>\r\n<p>&nbsp;</p>\r\n<p>Kebumen &ndash; Alhamdulillāh, prestasi membanggakan kembali diraih oleh anak-anak asuh LKSA Panti Asuhan Muhammadiyah Semarang dalam ajang Jambore Ke-4 MMC-LKSA Panti Asuhan Muhammadiyah &amp; Aisyiyah Jawa Tengah yang diselenggarakan di Pantai Kembar, Kebumen.</p>\r\n<p><br>Kegiatan jambore ini menjadi ajang silaturahmi, pembinaan karakter, pengembangan bakat, serta mempererat ukhuwah antaranak asuh LKSA Muhammadiyah dan Aisyiyah se-Jawa Tengah. Selama kegiatan berlangsung, para peserta mengikuti berbagai agenda edukatif, keagamaan, kebersamaan, dan perlombaan yang berlangsung dengan penuh semangat.</p>\r\n<p>Pada kesempatan yang membanggakan ini, Kontingen LKSA Panti Asuhan Muhammadiyah Semarang berhasil meraih Juara 1 pada cabang lomba Musikalisasi Puisi. Prestasi ini merupakan buah dari kerja keras, latihan yang sungguh-sungguh, bimbingan para pendamping, serta semangat pantang menyerah yang ditunjukkan oleh seluruh peserta.</p>\r\n<p>Keberhasilan ini menjadi motivasi bagi seluruh anak asuh untuk terus mengembangkan potensi, meningkatkan rasa percaya diri, serta mengharumkan nama LKSA Panti Asuhan Muhammadiyah Semarang di berbagai kesempatan.</p>\r\n<p>Semoga capaian ini menjadi penyemangat untuk terus berkarya, berprestasi, dan menjadi generasi yang berakhlak mulia, berilmu, serta bermanfaat bagi umat dan bangsa.</p>\r\n<p>Selamat kepada seluruh kontingen LKSA Panti Asuhan Muhammadiyah Semarang atas raihan Juara 1 Musikalisasi Puisi. Teruslah berkarya, menginspirasi, dan membawa nama baik persyarikatan Muhammadiyah.</p>', 'news/covers/jumEuIiokO5yCfWKf7LKUeUrdVwHoklFshOdlORw.jpg', 'published', '2026-07-25 14:38:10', 1, 'Prestasi Panti Asuhan Muhammadiyah Semarang dalam ajang Jambore Ke-4 MMC-LKSA Panti Asuhan Muhammadiyah & Aisyiyah Jawa Tengah yang diselenggarakan di Pantai Kembar, Kebumen.', 'Panti Asuhan Muhammadiyah Semarang dalam ajang Jambore Ke-4 MMC-LKSA Panti Asuhan Muhammadiyah & Aisyiyah Jawa Tengah yang diselenggarakan di Pantai Kembar, Kebumen.', '2026-07-25 07:20:07', '2026-07-25 14:38:10');

-- Dumping structure for table panti_asuhan.organization_members
CREATE TABLE IF NOT EXISTS `organization_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `level` tinyint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `organization_members_parent_id_index` (`parent_id`),
  KEY `organization_members_sort_order_index` (`sort_order`),
  KEY `organization_members_is_active_index` (`is_active`),
  CONSTRAINT `organization_members_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `organization_members` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.organization_members: ~13 rows (approximately)
INSERT INTO `organization_members` (`id`, `name`, `position`, `photo`, `parent_id`, `sort_order`, `level`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Dr. K.H. Fachur Rozi,M.Ag', 'Pimpinan Daerah Muhammadiyah(PDM)Semarang', NULL, NULL, 1, 0, 1, '2026-07-22 21:59:17', '2026-07-22 21:59:17'),
	(2, 'dr. Sarwoko Oetomo,MMR., FISQua', 'Majelis Pembinaan Kesejahteraan Sosial(MPKS) PDM Kota Semarang', 'organization/photos/jwmz3C969QNMICzNaFO3cx7pS2Gk0k74aSrarsPn.jpg', 1, 2, 1, 1, '2026-07-22 22:01:07', '2026-07-22 22:03:35'),
	(3, 'H. Muh Syamsuddin, S.sos., M.M', 'Ketua', NULL, 2, 1, 2, 1, '2026-07-22 22:02:39', '2026-07-22 22:58:38'),
	(4, 'Muh Natsir Noor effendi, S.H', 'Sekretaris', NULL, 3, 0, 3, 1, '2026-07-22 22:59:44', '2026-07-22 23:00:13'),
	(5, 'Santoso, S.E', 'Bendahara', NULL, 3, 2, 3, 1, '2026-07-22 23:01:04', '2026-07-22 23:01:04'),
	(6, 'Fitri Fidia Lestari', 'Staf Pengurus', NULL, 3, 3, 3, 1, '2026-07-22 23:02:24', '2026-07-22 23:10:45'),
	(7, 'Ahmad Dahlan', 'Kepala Panti', NULL, 3, 1, 4, 1, '2026-07-22 23:05:08', '2026-07-22 23:10:56'),
	(8, 'Dimas Khijri Saputra, M.Pd', 'Staf Pendidikan', NULL, 7, 1, 5, 1, '2026-07-22 23:12:52', '2026-07-22 23:12:52'),
	(9, 'Wisnu', 'Staf Media Informasi & Publikasi', NULL, 7, 2, 5, 1, '2026-07-22 23:13:30', '2026-07-22 23:13:30'),
	(10, 'Siswanti', 'Staf Dapur / Juru Masak', NULL, 7, 3, 5, 1, '2026-07-22 23:14:23', '2026-07-22 23:14:23'),
	(11, 'Muhammad Riski Isnaedi', 'Staf Tata Usaha(TU)', NULL, 7, 4, 5, 1, '2026-07-22 23:15:08', '2026-07-22 23:15:08'),
	(12, 'Jasmari', 'Staf Kedisiplinan,Kebersihan,dan Keamanan', NULL, 7, 5, 5, 1, '2026-07-22 23:16:00', '2026-07-22 23:16:00'),
	(13, 'mas alan', 'Staff Asisten TU', NULL, 11, 1, 7, 1, '2026-07-28 17:00:07', '2026-07-28 17:10:31');

-- Dumping structure for table panti_asuhan.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.pages: ~3 rows (approximately)
INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
	(1, 'tentang-kami', 'Tentang Kami', '<h2>Sejarah Panti Asuhan</h2>\r\n<div class="otQkpb" role="heading" aria-level="3" data-animation-nesting="" data-sfc-cp="" data-sfc-root="ep" data-sfc-cb="" data-complete="true" data-processed="true" data-sae="" data-copy-service-computed-style="font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 20px; font-weight: 600; margin: 24px 0px 12px; text-decoration: none; border-bottom: 0px rgb(230, 232, 240);">SEJARAH BERDIRINYA PANTI ASUHAN MUHAMMADIYAH<!--TgQPHd||[]--></div>\r\n<div class="n6owBd awi2gc" data-sfc-cp="" data-sfc-root="ep" data-sfc-cb="" data-hveid="CAAIBxAA" data-complete="true" data-processed="true" data-copy-service-computed-style="font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(230, 232, 240);">Panti Asuhan Muhammadiyah merupakan salah satu pilar gerak sosial tertua yang dimiliki oleh organisasi Muhammadiyah. Institusi ini lahir dari pemikiran mendalam KH Ahmad Dahlan mengenai teologi Surah Al-Ma\'un, yang menegaskan kewajiban setiap muslim untuk menyantuni anak yatim dan membantu kaum dhuafa. Gagasan mengenai wadah khusus pengasuhan ini mulai dirumuskan sejak tahun 1919 oleh Pimpinan Pusat Muhammadiyah (saat itu disebut <em class="eujQNb" data-sfc-root="ep" data-sfc-cb="" data-complete="true" data-processed="true" data-copy-service-computed-style="font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 0px; text-decoration: none; border-bottom: 0px rgb(230, 232, 240);">Hoofbestuur<!--TgQPHd||[]--></em>).<!--TgQPHd||[]--></div>\r\n<div class="n6owBd awi2gc" data-sfc-cp="" data-sfc-root="ep" data-sfc-cb="" data-hveid="CAAICBAA" data-complete="true" data-processed="true" data-copy-service-computed-style="font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(230, 232, 240);">Secara resmi, Panti Asuhan Muhammadiyah pertama kali berdiri pada tahun 1921 di Yogyakarta. Pada masa awal operasionalnya, lembaga ini belum memiliki gedung atau fasilitas khusus. Sebagai solusinya, para pengurus dan anggota Muhammadiyah secara sukarela membawa dan merawat anak-anak yatim tersebut langsung di dalam rumah tangga mereka masing-masing.<!--TgQPHd||[]--></div>\r\n<div class="n6owBd awi2gc" data-sfc-cp="" data-sfc-root="ep" data-sfc-cb="" data-hveid="CAAICRAA" data-complete="true" data-processed="true" data-copy-service-computed-style="font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(230, 232, 240);">Seiring bertambahnya jumlah anak asuh, sistem manajemen mulai dikembangkan secara lebih spesifik. Pada tahun 1928, pengelolaan panti asuhan resmi dipisah menjadi dua lembaga demi efisiensi pengasuhan. Panti Asuhan Yatim Putra dikelola langsung di bawah bendera Muhammadiyah, sementara Panti Asuhan Yatim Putri diserahkan pengelolaannya kepada organisasi otonom perempuan, \'Aisyiyah.<!--TgQPHd||[]--></div>\r\n<div class="n6owBd awi2gc" data-sfc-cp="" data-sfc-root="ep" data-sfc-cb="" data-hveid="CAAIChAA" data-complete="true" data-processed="true" aria-owns="action-menu-parent-container" data-copy-service-computed-style="font-family: &quot;Google Sans&quot;, Arial, sans-serif; font-size: 16px; font-weight: 400; margin: 12px 0px 16px; text-decoration: none; border-bottom: 0px rgb(230, 232, 240);">Hingga saat ini, kedua panti asuhan historis tersebut masih beroperasi secara aktif di Yogyakarta. Panti asuhan putra kini bertempat di Jalan Lowanu, Mergangsan, sedangkan panti asuhan putri bertempat di Jalan Munir, Ngampilan. Model pengasuhan rumahan di masa lampau kini telah bertransformasi menjadi jaringan institusi modern berskala nasional yang dikenal sebagai Lembaga Kesejahteraan Sosial Anak (LKSA) Muhammadiyah dan \'Aisyiyah di seluruh Indonesia.</div>', 'Tentang Kami — Panti Asuhan Muhammadiyah Semarang', 'Sejarah, visi, dan misi Panti Asuhan Muhammadiyah Semarang.', '2026-07-22 07:09:19', '2026-07-22 23:41:17'),
	(2, 'visi-misi', 'Visi & Misi', '<h2>Visi</h2>\r\n<p>Mewujudkan cita-cita Muhammadiyah yakni menjunjung tinggi Agama<br>Islam yang beraqidah Tauhid, bersumber kepada Al Qur\'an dan Sunnah<br>Rasulullah SAW sehingga terwujud masyarakat Islam yang sebenarbenarnya, melalui Pendidikan dan Pembinaan anak asuh sehingga<br>terwujud generasi yang beriman berakhlak mulia, berilmu dan mandir.</p>\r\n<h2>Misi</h2>\r\n<ul>\r\n<li>Menyelenggarakan pendidikan agama dan keagamaan bagi anak&nbsp;asuh</li>\r\n<li>Memberikan pengasuhan dan pembinaan serta membantu tumbuh&nbsp;kembang jasmani dan ruhani anak asuh secara wajar</li>\r\n<li>Melindungi dan mengembangkan kemampuan anak asuh untuk&nbsp;menjadi pribadi tangguh dan memahami jati diri sebagai muslim</li>\r\n<li>Menyiapkan anak asuh menghadapi masa depan yang gemilang</li>\r\n<li>Menjadikan Panti Asuhan Muhammadiyah sebagai ajang kaderisasi&nbsp;Muhammadiyah</li>\r\n</ul>\r\n<h2>Moto</h2>\r\n<p style="text-align: center;"><em><strong>&ldquo;Hidup-hidupilah Muhammadiyah dan Jangan mencari Kehidupan di</strong></em><br><em><strong>Muhammadiyah&rdquo;</strong></em><br><strong>المحافظة على القديم الصالح واألخذ بالجديد األصلح</strong><br><em><strong>"Melestarikan tradisi lama yang baik, dan mengambil hal baru yang lebih baik.</strong></em></p>', 'Visi Misi & Moto — Panti Asuhan Muhammadiyah Semarang', 'Visi Misi & Moto —  Panti Asuhan Muhammadiyah Semarang.', '2026-07-22 07:09:19', '2026-07-22 23:46:35'),
	(3, 'sop-pengasuhan', 'SOP Pengasuhan Anak', '<div id="model-response-message-contentr_bfdaa39807dcd4d3" class="markdown markdown-main-panel enable-luminous-fast-follows enable-updated-hr-color stronger" dir="ltr" aria-busy="false" aria-live="polite">\r\n<p style="text-align: left;" data-path-to-node="2"><strong>I. DASAR HUKUM</strong></p>\r\n<ol style="text-align: left;" data-path-to-node="3">\r\n<li>\r\n<p data-path-to-node="3,0,0">Undang-Undang Nomor 35 Tahun 2014 tentang Perubahan atas Undang-Undang Nomor 23 Tahun 2002 tentang Perlindungan Anak.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="3,1,0">Undang-Undang Nomor 11 Tahun 2009 tentang Kesejahteraan Sosial.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="3,2,0">Peraturan Menteri Sosial dan ketentuan lain yang berkaitan dengan pengasuhan anak.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="3,3,0">Kebijakan dan Anggaran Dasar Rumah Tangga Lembaga Muhammadiyah.</p>\r\n</li>\r\n</ol>\r\n<p style="text-align: left;" data-path-to-node="4"><strong data-path-to-node="4" data-index-in-node="0">II. TUJUAN</strong></p>\r\n<ol style="text-align: left;" data-path-to-node="5">\r\n<li>\r\n<p data-path-to-node="5,0,0">Menjamin terpenuhinya hak-hak anak dalam pengasuhan.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="5,1,0">Memberikan pedoman bagi pengasuh dan petugas dalam memberikan layanan pengasuhan.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="5,2,0">Menjamin pelayanan pengasuhan dilaksanakan secara aman, terencana, dan berkelanjutan.</p>\r\n</li>\r\n</ol>\r\n<p style="text-align: left;" data-path-to-node="6"><strong data-path-to-node="6" data-index-in-node="0">III. RUANG LINGKUP</strong></p>\r\n<ol style="text-align: left;" data-path-to-node="7">\r\n<li>\r\n<p data-path-to-node="7,0,0">Penerimaan anak.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="7,1,0">Pengasuhan sehari-hari.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="7,2,0">Pemenuhan kebutuhan dasar.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="7,3,0">Pendidikan dan kesehatan.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="7,4,0">Pembinaan mental, spiritual, dan sosial.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="7,5,0">Monitoring dan evaluasi perkembangan anak.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="7,6,0">Penguatan keluarga dan reunifikasi.</p>\r\n</li>\r\n</ol>\r\n<p style="text-align: left;" data-path-to-node="8"><strong data-path-to-node="8" data-index-in-node="0">IV. PIHAK YANG BERTANGGUNG JAWAB</strong></p>\r\n<ol style="text-align: left;" data-path-to-node="9">\r\n<li>\r\n<p data-path-to-node="9,0,0">Pimpinan Daerah Muhammadiyah (PDM) Kota Semarang.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="9,1,0">Majelis Pembinaan Kesejahteraan Sosial (MPKS) PDM Kota Semarang.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="9,2,0">Ketua Pengurus/Kepala Panti.</p>\r\n</li>\r\n<li>\r\n<p data-path-to-node="9,3,0">Pengasuh/Pengelola.</p>\r\n</li>\r\n</ol>\r\n<p style="text-align: left;" data-path-to-node="10">&nbsp;</p>\r\n<p style="text-align: left;" data-path-to-node="10">&nbsp;</p>\r\n<p style="text-align: center; padding-left: 480px;" data-path-to-node="10">Semarang, 1 Juni 2026</p>\r\n<p style="text-align: center; padding-left: 480px;" data-path-to-node="11"><strong data-path-to-node="11" data-index-in-node="0">Ketua Pengurus</strong></p>\r\n<p style="text-align: center; padding-left: 480px;" data-path-to-node="12">LKSA Panti Asuhan Muhammadiyah</p>\r\n<p style="text-align: center; padding-left: 480px;" data-path-to-node="13">Kota Semarang</p>\r\n<p style="text-align: center; padding-left: 480px;" data-path-to-node="13"><strong>H.M Syamsuddin, S.Sos., M.M</strong><br><strong>NBM: 880.783</strong></p>\r\n</div>', 'SOP Pengasuhan — Panti Asuhan Muhammadiyah Semarang', 'Standar Operasional Prosedur pengasuhan anak di Panti Asuhan Muhammadiyah Semarang.', '2026-07-22 07:09:19', '2026-07-22 23:54:07');

-- Dumping structure for table panti_asuhan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table panti_asuhan.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('j4aPsQ0V1uq0vNCqWXmukWngVe0O42se0uiJ9uLH', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiIwc1VXaUdpaXRpNmlZZUtrQ0R0dDk0WTg0eFhYSFcwaEZ2NUU0NTFGIiwiX2ZsYXNoIjp7Im5ldyI6W10sIm9sZCI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2FkbWluXC9idWt1LWthcyIsInJvdXRlIjoiYWRtaW4uYnVrdS1rYXMuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1785446021),
	('OSX6pwx5JkGW5TxK5xTkAfqANbCeA6zTcW2OQe09', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJwbXAwYW43NDNGblI5TnFZSnJYeUNoUldmeGJ5TlN1NTdqQ29hWUdDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL3dlYnBhbnRpYXN1aGFuLnRlc3Q6ODA4MCIsInJvdXRlIjoiaG9tZSJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1785455865);

-- Dumping structure for table panti_asuhan.site_settings
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`),
  KEY `site_settings_group_index` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.site_settings: ~15 rows (approximately)
INSERT INTO `site_settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
	(1, 'site_name', 'LKSA Panti Asuhan Muhammadiyah Semarang', 'general', '2026-07-22 07:09:19', '2026-07-22 08:11:22'),
	(2, 'site_description', 'Yayasan Kesejahteraan Sosial yang bergerak dalam bidang pengasuhan dan pembinaan anak yatim, piatu, yatim piatu, dan dhuafa.', 'general', '2026-07-22 07:09:19', '2026-07-22 07:09:19'),
	(3, 'address', 'Jl. Giri Mukti Bar. II No.19, Tlogosari Kulon, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50196', 'contact', '2026-07-22 07:09:19', '2026-07-22 21:54:08'),
	(4, 'phone', '6285165810824', 'contact', '2026-07-22 07:09:19', '2026-07-23 01:25:57'),
	(5, 'email', 'mcc.lksa.pamuh.smg@gmail.com', 'contact', '2026-07-22 07:09:19', '2026-07-22 23:58:42'),
	(6, 'whatsapp_number', '6285165810824', 'contact', '2026-07-22 07:09:19', '2026-07-23 01:26:52'),
	(7, 'whatsapp_message', 'Assalamu\'alaikum, saya ingin bertanya tentang Panti Asuhan Muhammadiyah Semarang.', 'contact', '2026-07-22 07:09:19', '2026-07-22 07:09:19'),
	(8, 'google_maps_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.179454393031!2d110.46018437442082!3d-6.9881316684348915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708cdb5955f7fd%3A0x2dd118c3e56d1f3a!2sPanti%20Asuhan%20Muhammadiyah!5e0!3m2!1sid!2sid!4v1784782466727!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin', 'contact', '2026-07-22 07:09:19', '2026-07-22 21:55:23'),
	(9, 'instagram', 'https://www.instagram.com/mcc.lksa.pamuh.smg', 'social', '2026-07-22 07:09:19', '2026-07-22 23:57:13'),
	(10, 'facebook', NULL, 'social', '2026-07-22 07:09:19', '2026-07-22 23:57:13'),
	(11, 'youtube', 'https://www.youtube.com/@MCC-LKSA_Pamuh_Smg', 'social', '2026-07-22 07:09:19', '2026-07-22 23:57:13'),
	(12, 'tiktok', NULL, 'social', '2026-07-22 07:09:19', '2026-07-22 23:57:13'),
	(13, 'bank_name', 'Bank Syariah Indonesia (BSI)', 'donation', '2026-07-22 07:09:19', '2026-07-22 07:09:19'),
	(14, 'bank_account_number', '1234567890', 'donation', '2026-07-22 07:09:19', '2026-07-22 07:09:19'),
	(15, 'bank_account_name', 'Yayasan Panti Asuhan Muhammadiyah Semarang', 'donation', '2026-07-22 07:09:19', '2026-07-22 07:09:19'),
	(16, 'logo_primary', 'logos/7iHnYnFEJ462l8KXVOhAWMaGt5dVUTXJX7nmWnMA.jpg', 'general', '2026-07-22 08:09:19', '2026-07-22 08:09:19'),
	(17, 'logo_secondary', 'logos/B154pKXxW9vr1qqcJM7TrWSagf9jnKGRC7blboAc.jpg', 'general', '2026-07-22 08:09:19', '2026-07-22 08:09:19');

-- Dumping structure for table panti_asuhan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','donatur') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'donatur',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table panti_asuhan.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin Panti', 'admin', 'admin@pantiasuhan.org', '2026-07-22 07:09:18', '$2y$12$wich6PfuZc9SSkQnmmdpJeybQXIaD3a.rpmocPX1oAitLj1.lqN9W', 'ehdB4NiKtvvdfscIfpSAwoCd3JC5xSWqB3rYmbrskjRzr0ZZAbGSkRV18A3p', '2026-07-22 07:09:19', '2026-07-22 07:09:19'),
	(2, 'Salman.test', 'donatur', 'test@gmail.com', NULL, '$2y$12$N6n26osQal3i0oG/.y1Wx.Qm/EbEXgns796bYQpc9wYgZjzdCXq2u', NULL, '2026-07-30 03:14:51', '2026-07-30 03:14:51');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
