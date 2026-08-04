<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BukuKasController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OrganizationMemberController;
use App\Http\Controllers\Admin\SiteSettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/tentang-kami', [PublicController::class, 'about'])->name('about');
Route::get('/struktur-organisasi', [PublicController::class, 'organization'])->name('organization');
Route::get('/sop-pengasuhan', [PublicController::class, 'sop'])->name('sop');
Route::get('/profil/jadwal-kegiatan', [PublicController::class, 'jadwalKegiatan'])->name('jadwal-kegiatan');
Route::get('/berita', [PublicController::class, 'newsIndex'])->name('news.index');
Route::get('/berita/{slug}', [PublicController::class, 'newsShow'])->name('news.show');
Route::get('/galeri', [PublicController::class, 'galleryIndex'])->name('gallery.index');
Route::get('/galeri/{slug}', [PublicController::class, 'galleryShow'])->name('gallery.show');
Route::get('/donasi', [PublicController::class, 'donation'])->name('donation');
Route::get('/kontak', [PublicController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Guest only)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (not authenticated)
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    });

    // Logout (authenticated)
    Route::post('logout', [AuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    /*
    |----------------------------------------------------------------------
    | Admin Protected Routes
    |----------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {

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
        Route::put('settings/jadwal-kegiatan', [SiteSettingController::class, 'updateJadwalKegiatan'])->name('settings.update-jadwal-kegiatan');

        // Buku Kas — Financial Transparency
        Route::prefix('buku-kas')->name('buku-kas.')->group(function () {
            Route::get('/', [BukuKasController::class, 'index'])->name('index');
            Route::get('export', [BukuKasController::class, 'export'])->name('export');

            // Donors
            Route::post('donors', [BukuKasController::class, 'storeDonor'])->name('donors.store');
            Route::put('donors/{donor}', [BukuKasController::class, 'updateDonor'])->name('donors.update');
            Route::delete('donors/{donor}', [BukuKasController::class, 'destroyDonor'])->name('donors.destroy');

            // Expenses / RAB
            Route::post('expenses', [BukuKasController::class, 'storeExpense'])->name('expenses.store');
            Route::put('expenses/{expense}', [BukuKasController::class, 'updateExpense'])->name('expenses.update');
            Route::delete('expenses/{expense}', [BukuKasController::class, 'destroyExpense'])->name('expenses.destroy');
            Route::patch('expenses/{expense}/toggle', [BukuKasController::class, 'toggleExpenseStatus'])->name('expenses.toggle');
        });
    });
});
