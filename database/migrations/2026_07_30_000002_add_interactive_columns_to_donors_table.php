<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Menambahkan kolom interaktif ke tabel donors.
 *
 * Kolom baru:
 * - user_id    : FK ke users (nullable, untuk donatur terdaftar. NULL = input manual admin/WA)
 * - proof_image: Path ke file bukti transfer yang diunggah donatur
 * - status     : Status validasi donasi ('menunggu' atau 'tervalidasi')
 * - prayer     : Doa & harapan dari donatur (ditampilkan di Kotak Doa publik)
 *
 * Data donasi yang sudah ada sebelumnya akan otomatis di-set ke 'tervalidasi'
 * agar saldo keuangan tidak berubah secara tiba-tiba.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            // Relasi ke user (nullable — donasi manual admin tidak punya user_id)
            $table->foreignId('user_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('users')
                  ->nullOnDelete();

            // Path ke file bukti transfer (storage/app/public/proof_images/...)
            $table->string('proof_image')->nullable()->after('is_anonymous');

            // Status validasi donasi
            $table->enum('status', ['menunggu', 'tervalidasi'])
                  ->default('menunggu')
                  ->after('proof_image');

            // Doa & harapan dari donatur
            $table->text('prayer')->nullable()->after('status');
        });

        // Set semua data donasi lama ke 'tervalidasi'
        // agar saldo keuangan tidak berubah
        \Illuminate\Support\Facades\DB::table('donors')
            ->update(['status' => 'tervalidasi']);
    }

    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'proof_image', 'status', 'prayer']);
        });
    }
};
