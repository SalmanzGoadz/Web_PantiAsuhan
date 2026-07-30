<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Menambahkan kolom 'role' ke tabel users.
 *
 * Kolom role menentukan hak akses pengguna:
 * - 'admin'   : Pengurus panti, bisa kelola CMS
 * - 'donatur' : Donatur terdaftar, bisa kirim donasi & lihat riwayat
 *
 * User yang sudah ada (admin) akan di-set role = 'admin' secara manual
 * atau via seeder. Default untuk pendaftar baru adalah 'donatur'.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom role setelah kolom 'name'
            $table->enum('role', ['admin', 'donatur'])
                  ->default('donatur')
                  ->after('name');
        });

        // Set semua user yang sudah ada menjadi 'admin'
        // karena sebelumnya hanya admin yang punya akun
        \Illuminate\Support\Facades\DB::table('users')
            ->whereNull('role')
            ->orWhere('role', 'donatur')
            ->update(['role' => 'admin']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
