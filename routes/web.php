<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BukuKasController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrganizationMemberController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Donatur\AuthController as DonaturAuthController;
use App\Http\Controllers\Donatur\DashboardController as DonaturDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Autentikasi)
|--------------------------------------------------------------------------
| Semua halaman ini bisa diakses oleh siapa saja tanpa login.
| Website ini pada dasarnya adalah Company Profile publik.
*/

use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PublicController::class, 'about'])->name('about');
Route::get('/struktur-organisasi', [PublicController::class, 'organization'])->name('organization');
Route::get('/sop-pengasuhan', [PublicController::class, 'sop'])->name('sop');
Route::get('/berita', [PublicController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{slug}', [PublicController::class, 'newsShow'])->name('news.show');
Route::get('/galeri', [PublicController::class, 'galleryIndex'])->name('gallery.index');
Route::get('/galeri/{slug}', [PublicController::class, 'galleryShow'])->name('gallery.show');
Route::get('/donasi', [PublicController::class, 'donation'])->name('donation');
Route::get('/kontak', [PublicController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| Donatur Authentication Routes (Guest only — Opsional)
|--------------------------------------------------------------------------
| Login & Register hanya untuk pengunjung yang INGIN menjadi donatur
| terdaftar. Fitur ini bersifat opsional — website tetap bisa diakses
| tanpa login.
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [DonaturAuthController::class, 'showLoginForm'])->name('donatur.login');
    Route::post('/login', [DonaturAuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [DonaturAuthController::class, 'showRegisterForm'])->name('donatur.register');
    Route::post('/register', [DonaturAuthController::class, 'register']);
});

// Logout donatur (harus login)
Route::post('/logout', [DonaturAuthController::class, 'logout'])
    ->middleware('auth')
    ->name('donatur.logout');

/*
|--------------------------------------------------------------------------
| Donatur Protected Routes (Login Required + Role Donatur)
|--------------------------------------------------------------------------
| Area khusus donatur terdaftar — melihat riwayat donasi & kirim donasi baru.
*/

Route::prefix('donatur')->name('donatur.')->middleware(['auth', 'role:donatur'])->group(function () {
    Route::get('/dashboard', [DonaturDashboardController::class, 'index'])->name('dashboard');
    Route::get('/donasi/kirim', [DonaturDashboardController::class, 'createDonation'])->name('donation.create');
    Route::post('/donasi/kirim', [DonaturDashboardController::class, 'storeDonation'])->name('donation.store');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Guest only)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (belum login)
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    });

    // Logout (harus login)
    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    /*
    |----------------------------------------------------------------------
    | Admin Protected Routes (Login Required + Role Admin)
    |----------------------------------------------------------------------
    */

    Route::middleware(['auth', 'role:admin'])->group(function () {

        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', fn () => redirect()->route('admin.dashboard'));

        // News Management
        Route::resource('news', NewsController::class)->except(['show']);

        // Gallery Management
        Route::resource('galleries', GalleryController::class)->except(['show']);
        Route::delete('gallery-items/{item}', [GalleryController::class, 'destroyItem'])->name('gallery-items.destroy');
        Route::patch('gallery-items/{item}', [GalleryController::class, 'updateItem'])->name('gallery-items.update');

        // Organization Structure Management
        Route::resource('organization', OrganizationMemberController::class)->except(['show']);

        // Hero Slider Management
        Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
        Route::post('hero-slides/reorder', [HeroSlideController::class, 'reorder'])->name('hero-slides.reorder');

        // Site Settings
        Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
        Route::put('settings/general', [SiteSettingController::class, 'updateGeneral'])->name('settings.update-general');
        Route::put('settings/contact', [SiteSettingController::class, 'updateContact'])->name('settings.update-contact');
        Route::put('settings/social', [SiteSettingController::class, 'updateSocial'])->name('settings.update-social');
        Route::put('settings/donation', [SiteSettingController::class, 'updateDonation'])->name('settings.update-donation');
        Route::put('settings/page/{slug}', [SiteSettingController::class, 'updatePage'])->name('settings.update-page');

        // Buku Kas — Transparansi Keuangan
        Route::prefix('buku-kas')->name('buku-kas.')->group(function () {
            Route::get('/', [BukuKasController::class, 'index'])->name('index');

            // Donors
            Route::post('donors', [BukuKasController::class, 'storeDonor'])->name('donors.store');
            Route::put('donors/{donor}', [BukuKasController::class, 'updateDonor'])->name('donors.update');
            Route::delete('donors/{donor}', [BukuKasController::class, 'destroyDonor'])->name('donors.destroy');

            // Validasi donasi (tombol Validasi di dashboard admin)
            Route::patch('donors/{donor}/validate', [BukuKasController::class, 'validateDonor'])->name('donors.validate');

            // Expenses / RAB
            Route::post('expenses', [BukuKasController::class, 'storeExpense'])->name('expenses.store');
            Route::put('expenses/{expense}', [BukuKasController::class, 'updateExpense'])->name('expenses.update');
            Route::delete('expenses/{expense}', [BukuKasController::class, 'destroyExpense'])->name('expenses.destroy');
            Route::patch('expenses/{expense}/toggle', [BukuKasController::class, 'toggleExpenseStatus'])->name('expenses.toggle');
        });
    });
});
