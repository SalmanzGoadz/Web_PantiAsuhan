<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Donor;
use App\Models\Expense;
use App\Models\Gallery;
use App\Models\News;
use App\Models\OrganizationMember;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     *
     * Update: Kalkulasi saldo sekarang hanya menghitung donasi 'tervalidasi'.
     * Ditambahkan data antrian donasi yang menunggu validasi.
     */
    public function index(): View
    {
        // Kalkulasi saldo — HANYA donasi yang sudah tervalidasi
        $totalDonors = Donor::tervalidasi()->sum('amount');
        $totalExpensesTerlaksana = Expense::terlaksana()->sum('amount');

        // Jumlah donasi yang menunggu validasi (untuk badge notifikasi)
        $pendingDonationsCount = Donor::menunggu()->count();

        $stats = [
            'total_news' => News::count(),
            'published_news' => News::where('status', 'published')->count(),
            'draft_news' => News::where('status', 'draft')->count(),
            'total_galleries' => Gallery::count(),
            'total_members' => OrganizationMember::where('is_active', true)->count(),
            'total_balance' => $totalDonors - $totalExpensesTerlaksana,
            'total_donors' => $totalDonors,
            'donor_count' => Donor::count(),
            'pending_donations' => $pendingDonationsCount,
        ];

        $recentActivities = ActivityLog::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Ambil donasi yang menunggu validasi (untuk ditampilkan di dashboard)
        $pendingDonations = Donor::menunggu()
            ->latestFirst()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities', 'pendingDonations'));
    }
}
