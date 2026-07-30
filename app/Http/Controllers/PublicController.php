<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Expense;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\News;
use App\Models\OrganizationMember;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Tampilkan halaman beranda.
     *
     * Update: Menambahkan data doa & harapan dari donasi tervalidasi
     * untuk ditampilkan di section Kotak Doa.
     */
    public function home(): View
    {
        $slides = HeroSlide::active()->ordered()->get();
        $recentNews = News::published()->latestPublished()->take(3)->get();
        $recentGalleries = Gallery::published()->latestPublished()->take(3)->get();
        
        $aboutPage = Page::findBySlug('tentang-kami');

        // Ambil doa & harapan dari donasi tervalidasi untuk Kotak Doa
        // Hanya tampilkan yang memiliki doa (prayer tidak null/kosong)
        $prayers = Donor::tervalidasi()
            ->whereNotNull('prayer')
            ->where('prayer', '!=', '')
            ->latestFirst()
            ->take(12)
            ->get();
        
        return view('home', compact('slides', 'recentNews', 'recentGalleries', 'aboutPage', 'prayers'));
    }

    /**
     * Tampilkan halaman Tentang Kami.
     */
    public function about(): View
    {
        $aboutPage = Page::findBySlug('tentang-kami');
        $visiMisiPage = Page::findBySlug('visi-misi');
        
        return view('about', compact('aboutPage', 'visiMisiPage'));
    }

    /**
     * Tampilkan halaman Struktur Organisasi (diagram dinamis).
     */
    public function organization(): View
    {
        $orgTree = OrganizationMember::getTree();
        
        return view('organization', compact('orgTree'));
    }

    /**
     * Tampilkan halaman SOP.
     */
    public function sop(): View
    {
        $sopPage = Page::findBySlug('sop-pengasuhan');
        
        return view('sop', compact('sopPage'));
    }

    /**
     * Tampilkan daftar berita yang sudah dipublikasikan.
     */
    public function newsIndex(Request $request): View
    {
        $query = News::published()->latestPublished();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $news = $query->paginate(9)->withQueryString();

        return view('news.index', compact('news'));
    }

    /**
     * Tampilkan detail berita.
     */
    public function newsShow(string $slug): View
    {
        $article = News::published()->where('slug', $slug)->firstOrFail();
        
        // Berita terbaru untuk sidebar (kecuali artikel saat ini)
        $recentNews = News::published()
            ->where('id', '!=', $article->id)
            ->latestPublished()
            ->take(5)
            ->get();

        return view('news.show', compact('article', 'recentNews'));
    }

    /**
     * Tampilkan daftar galeri yang sudah dipublikasikan.
     */
    public function galleryIndex(): View
    {
        $galleries = Gallery::published()->latestPublished()->paginate(9);
        
        return view('gallery.index', compact('galleries'));
    }

    /**
     * Tampilkan detail album galeri.
     */
    public function galleryShow(string $slug): View
    {
        $gallery = Gallery::published()->where('slug', $slug)->firstOrFail();
        $gallery->load('items');

        return view('gallery.show', compact('gallery'));
    }

    /**
     * Tampilkan halaman informasi donasi & transparansi keuangan.
     *
     * Update: Kalkulasi saldo HANYA dari donasi yang sudah 'tervalidasi'.
     * Daftar donatur publik juga hanya menampilkan donasi tervalidasi.
     */
    public function donation(): View
    {
        $donationSettings = SiteSetting::getGroup('donation');

        // Kalkulasi keuangan — hanya donasi tervalidasi
        $totalDonors = Donor::tervalidasi()->sum('amount');
        $totalExpensesTerlaksana = Expense::terlaksana()->sum('amount');
        $totalBalance = $totalDonors - $totalExpensesTerlaksana;

        // Hanya tampilkan donatur yang sudah tervalidasi di halaman publik
        $recentDonors = Donor::tervalidasi()->latestFirst()->take(10)->get();
        $expenses = Expense::latestFirst()->get();

        return view('donation', compact(
            'donationSettings',
            'totalBalance',
            'totalDonors',
            'totalExpensesTerlaksana',
            'recentDonors',
            'expenses'
        ));
    }

    /**
     * Tampilkan halaman kontak.
     */
    public function contact(): View
    {
        $contactSettings = SiteSetting::getGroup('contact');
        
        return view('contact', compact('contactSettings'));
    }
}
