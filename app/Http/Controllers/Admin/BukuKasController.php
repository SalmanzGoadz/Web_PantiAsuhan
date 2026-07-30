<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDonorRequest;
use App\Http\Requests\Admin\StoreExpenseRequest;
use App\Http\Requests\Admin\UpdateDonorRequest;
use App\Http\Requests\Admin\UpdateExpenseRequest;
use App\Models\ActivityLog;
use App\Models\Donor;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BukuKasController extends Controller
{
    /**
     * Tampilkan halaman Buku Kas dengan data donatur & pengeluaran.
     *
     * Update: Kalkulasi saldo hanya dari donasi 'tervalidasi'.
     */
    public function index(Request $request): View
    {
        // Kalkulasi keuangan dinamis — HANYA donasi tervalidasi
        $totalDonors = Donor::tervalidasi()->sum('amount');
        $totalExpensesTerlaksana = Expense::terlaksana()->sum('amount');
        $totalExpensesRencana = Expense::rencana()->sum('amount');
        $totalBalance = $totalDonors - $totalExpensesTerlaksana;

        // Jumlah donasi menunggu validasi
        $pendingCount = Donor::menunggu()->count();

        $stats = [
            'total_donors' => $totalDonors,
            'total_expenses_terlaksana' => $totalExpensesTerlaksana,
            'total_expenses_rencana' => $totalExpensesRencana,
            'total_balance' => $totalBalance,
            'donor_count' => Donor::count(),
            'expense_count' => Expense::count(),
            'pending_count' => $pendingCount,
        ];

        // Daftar donatur dengan paginasi
        $donorsQuery = Donor::latestFirst();
        if ($request->filled('donor_search')) {
            $donorsQuery->where('name', 'like', '%' . $request->donor_search . '%');
        }
        // Filter berdasarkan status donasi
        if ($request->filled('donor_status')) {
            $donorsQuery->where('status', $request->donor_status);
        }
        $donors = $donorsQuery->paginate(15, ['*'], 'donor_page')->withQueryString();

        // Daftar pengeluaran dengan paginasi
        $expensesQuery = Expense::latestFirst();
        if ($request->filled('expense_search')) {
            $expensesQuery->where('title', 'like', '%' . $request->expense_search . '%');
        }
        if ($request->filled('expense_status')) {
            $expensesQuery->where('status', $request->expense_status);
        }
        $expenses = $expensesQuery->paginate(15, ['*'], 'expense_page')->withQueryString();

        return view('admin.buku-kas.index', compact('stats', 'donors', 'expenses'));
    }

    /* -------------------------------------------------------
     * DONORS CRUD
     * ----------------------------------------------------- */

    /**
     * Simpan donatur baru (input manual oleh admin).
     *
     * Update: Status default 'tervalidasi' karena admin yang input.
     * user_id dibiarkan null karena ini donasi manual (via WA/offline).
     */
    public function storeDonor(StoreDonorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_anonymous'] = $request->boolean('is_anonymous');

        // Status default 'tervalidasi' untuk input manual admin
        // Admin bisa pilih status lain jika diperlukan
        $data['status'] = $request->input('status', 'tervalidasi');

        // user_id null — donasi manual, bukan dari web
        $data['user_id'] = null;

        $donor = Donor::create($data);

        ActivityLog::log('created', $donor, "Menambah donatur (manual): {$donor->name} — Rp " . number_format($donor->amount, 0, ',', '.'));

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', 'Data donatur berhasil ditambahkan.');
    }

    /**
     * Update data donatur yang sudah ada.
     */
    public function updateDonor(UpdateDonorRequest $request, Donor $donor): RedirectResponse
    {
        $data = $request->validated();
        $data['is_anonymous'] = $request->boolean('is_anonymous');

        $donor->update($data);

        ActivityLog::log('updated', $donor, "Mengubah donatur: {$donor->name}");

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', 'Data donatur berhasil diperbarui.');
    }

    /**
     * Hapus data donatur.
     */
    public function destroyDonor(Donor $donor): RedirectResponse
    {
        $name = $donor->name;

        ActivityLog::log('deleted', $donor, "Menghapus donatur: {$name}");

        $donor->delete();

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', 'Data donatur berhasil dihapus.');
    }

    /**
     * Validasi donasi — ubah status dari 'menunggu' menjadi 'tervalidasi'.
     *
     * Digunakan oleh admin untuk memvalidasi donasi yang masuk dari web
     * setelah memeriksa bukti transfer.
     */
    public function validateDonor(Donor $donor): RedirectResponse
    {
        $donor->update(['status' => 'tervalidasi']);

        ActivityLog::log('updated', $donor, "Memvalidasi donasi dari: {$donor->name} — Rp " . number_format($donor->amount, 0, ',', '.'));

        return redirect()
            ->back()
            ->with('success', "Donasi dari \"{$donor->name}\" berhasil divalidasi.");
    }

    /* -------------------------------------------------------
     * EXPENSES CRUD
     * ----------------------------------------------------- */

    /**
     * Simpan pengeluaran baru.
     */
    public function storeExpense(StoreExpenseRequest $request): RedirectResponse
    {
        $expense = Expense::create($request->validated());

        ActivityLog::log('created', $expense, "Menambah pengeluaran: {$expense->title} — Rp " . number_format($expense->amount, 0, ',', '.'));

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

    /**
     * Update pengeluaran yang sudah ada.
     */
    public function updateExpense(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $expense->update($request->validated());

        ActivityLog::log('updated', $expense, "Mengubah pengeluaran: {$expense->title}");

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', 'Data pengeluaran berhasil diperbarui.');
    }

    /**
     * Hapus pengeluaran.
     */
    public function destroyExpense(Expense $expense): RedirectResponse
    {
        $title = $expense->title;

        ActivityLog::log('deleted', $expense, "Menghapus pengeluaran: {$title}");

        $expense->delete();

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    /**
     * Toggle status pengeluaran antara 'rencana' dan 'terlaksana'.
     */
    public function toggleExpenseStatus(Expense $expense): RedirectResponse
    {
        $expense->status = $expense->isTerlaksana() ? 'rencana' : 'terlaksana';
        $expense->save();

        $statusLabel = $expense->isTerlaksana() ? 'Terlaksana' : 'Rencana';

        ActivityLog::log('updated', $expense, "Mengubah status \"{$expense->title}\" menjadi {$statusLabel}");

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', "Status \"{$expense->title}\" diubah menjadi {$statusLabel}.");
    }
}
