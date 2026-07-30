<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware: Pengecekan Role Pengguna
 *
 * Middleware ini memeriksa apakah user yang sedang login memiliki
 * role yang sesuai dengan yang dibutuhkan oleh route.
 *
 * Penggunaan di route:
 *   ->middleware('role:admin')    — hanya admin yang bisa akses
 *   ->middleware('role:donatur')  — hanya donatur yang bisa akses
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        // Jika belum login, arahkan ke halaman login yang sesuai
        if (!$user) {
            if ($role === 'admin') {
                return redirect()->route('admin.login');
            }

            return redirect()->route('donatur.login');
        }

        // Cek apakah role user sesuai dengan yang dibutuhkan
        if ($user->role !== $role) {
            // Admin yang mencoba akses area donatur → redirect ke admin dashboard
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }

            // Donatur yang mencoba akses area admin → abort 403
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
