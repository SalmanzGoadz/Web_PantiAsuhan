<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Controller: Dashboard Donatur
 *
 * Menangani dashboard donatur yang sudah login:
 * - Melihat riwayat donasi pribadi
 * - Mengirim donasi baru (upload bukti + doa)
 */
class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard donatur dengan riwayat donasi.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Ambil semua donasi milik donatur ini, urutkan dari terbaru
        $donations = Donor::where('user_id', $user->id)
            ->latestFirst()
            ->paginate(10);

        // Statistik ringkasan donasi milik user
        $stats = [
            'total_donasi' => Donor::where('user_id', $user->id)->sum('amount'),
            'total_tervalidasi' => Donor::where('user_id', $user->id)->tervalidasi()->sum('amount'),
            'jumlah_donasi' => Donor::where('user_id', $user->id)->count(),
            'menunggu_count' => Donor::where('user_id', $user->id)->menunggu()->count(),
        ];

        return view('donatur.dashboard', compact('donations', 'stats'));
    }

    /**
     * Tampilkan form untuk mengirim donasi baru.
     */
    public function createDonation(): View
    {
        return view('donatur.donation-create');
    }

    /**
     * Proses penyimpanan donasi baru dari donatur.
     *
     * Status otomatis 'menunggu' karena perlu divalidasi admin.
     * user_id diisi dari user yang sedang login.
     */
    public function storeDonation(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:1000'],
            'proof_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'prayer' => ['nullable', 'string', 'max:500'],
            'is_anonymous' => ['nullable', 'boolean'],
        ], [
            'amount.required' => 'Jumlah donasi wajib diisi.',
            'amount.min' => 'Jumlah donasi minimal Rp 1.000.',
            'proof_image.required' => 'Bukti transfer wajib diunggah.',
            'proof_image.image' => 'File harus berupa gambar.',
            'proof_image.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau WebP.',
            'proof_image.max' => 'Ukuran gambar maksimal 2MB.',
            'prayer.max' => 'Doa & harapan maksimal 500 karakter.',
        ]);

        $user = Auth::user();

        // Upload bukti transfer ke storage/app/public/proof_images/
        $proofPath = $request->file('proof_image')
            ->store('proof_images', 'public');

        // Simpan data donasi
        Donor::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'amount' => $validated['amount'],
            'date' => now()->toDateString(),
            'is_anonymous' => $request->boolean('is_anonymous'),
            'proof_image' => $proofPath,
            'status' => 'menunggu', // Perlu validasi admin
            'prayer' => $validated['prayer'] ?? null,
        ]);

        return redirect()
            ->route('donatur.dashboard')
            ->with('success', 'Donasi Anda berhasil dikirim! Mohon tunggu validasi dari admin.');
    }
}
