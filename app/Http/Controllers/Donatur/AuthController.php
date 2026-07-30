<?php

namespace App\Http\Controllers\Donatur;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * Controller: Autentikasi Donatur
 *
 * Menangani proses login, registrasi, dan logout
 * khusus untuk pengguna dengan role 'donatur'.
 */
class AuthController extends Controller
{
    /**
     * Tampilkan form login donatur.
     */
    public function showLoginForm(): View
    {
        return view('donatur.auth.login');
    }

    /**
     * Proses login donatur.
     * Hanya mengizinkan user dengan role 'donatur'.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Jika yang login adalah admin, redirect ke admin dashboard
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            $request->session()->regenerate();
            return redirect()->intended(route('donatur.dashboard'));
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ]);
    }

    /**
     * Tampilkan form registrasi donatur.
     */
    public function showRegisterForm(): View
    {
        return view('donatur.auth.register');
    }

    /**
     * Proses registrasi donatur baru.
     * Role otomatis diset ke 'donatur'.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // Buat user baru dengan role 'donatur' (default)
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'donatur', // Role default untuk pendaftar baru
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        return redirect()
            ->route('donatur.dashboard')
            ->with('success', 'Selamat datang! Akun donatur Anda berhasil dibuat.');
    }

    /**
     * Proses logout donatur.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda telah berhasil keluar.');
    }
}
