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
     * Display the Buku Kas dashboard with both donors & expenses.
     */
    public function index(Request $request): View
    {
        // Dynamic financial calculation
        $totalDonors = Donor::sum('amount');
        $totalExpensesTerlaksana = Expense::terlaksana()->sum('amount');
        $totalExpensesRencana = Expense::rencana()->sum('amount');
        $totalBalance = $totalDonors - $totalExpensesTerlaksana;

        $stats = [
            'total_donors' => $totalDonors,
            'total_expenses_terlaksana' => $totalExpensesTerlaksana,
            'total_expenses_rencana' => $totalExpensesRencana,
            'total_balance' => $totalBalance,
            'donor_count' => Donor::count(),
            'expense_count' => Expense::count(),
        ];

        // Donors list with pagination
        $donorsQuery = Donor::latestFirst();
        if ($request->filled('donor_search')) {
            $donorsQuery->where('name', 'like', '%' . $request->donor_search . '%');
        }
        $donors = $donorsQuery->paginate(15, ['*'], 'donor_page')->withQueryString();

        // Expenses list with pagination
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
     * Store a new donor.
     */
    public function storeDonor(StoreDonorRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_anonymous'] = $request->boolean('is_anonymous');

        $donor = Donor::create($data);

        ActivityLog::log('created', $donor, "Menambah donatur: {$donor->name} — Rp " . number_format($donor->amount, 0, ',', '.'));

        return redirect()
            ->route('admin.buku-kas.index')
            ->with('success', 'Data donatur berhasil ditambahkan.');
    }

    /**
     * Update an existing donor.
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
     * Delete a donor.
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

    /* -------------------------------------------------------
     * EXPENSES CRUD
     * ----------------------------------------------------- */

    /**
     * Store a new expense.
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
     * Update an existing expense.
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
     * Delete an expense.
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
     * Toggle expense status between rencana and terlaksana.
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
