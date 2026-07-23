<?php

namespace App\Http\Controllers;

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
     * Show the homepage.
     */
    public function home(): View
    {
        $slides = HeroSlide::active()->ordered()->get();
        $recentNews = News::published()->latestPublished()->take(3)->get();
        $recentGalleries = Gallery::published()->latestPublished()->take(3)->get();
        
        $aboutPage = Page::findBySlug('tentang-kami');
        
        return view('home', compact('slides', 'recentNews', 'recentGalleries', 'aboutPage'));
    }

    /**
     * Show the About Us page.
     */
    public function about(): View
    {
        $aboutPage = Page::findBySlug('tentang-kami');
        $visiMisiPage = Page::findBySlug('visi-misi');
        
        return view('about', compact('aboutPage', 'visiMisiPage'));
    }

    /**
     * Show the Organization Structure page (dynamic diagram).
     */
    public function organization(): View
    {
        $orgTree = OrganizationMember::getTree();
        
        return view('organization', compact('orgTree'));
    }

    /**
     * Show the SOP page.
     */
    public function sop(): View
    {
        $sopPage = Page::findBySlug('sop-pengasuhan');
        
        return view('sop', compact('sopPage'));
    }

    /**
     * Show the listing of published news.
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
     * Show a specific news article.
     */
    public function newsShow(string $slug): View
    {
        $article = News::published()->where('slug', $slug)->firstOrFail();
        
        // Fetch recent news for sidebar (excluding current article)
        $recentNews = News::published()
            ->where('id', '!=', $article->id)
            ->latestPublished()
            ->take(5)
            ->get();

        return view('news.show', compact('article', 'recentNews'));
    }

    /**
     * Show the listing of published galleries.
     */
    public function galleryIndex(): View
    {
        $galleries = Gallery::published()->latestPublished()->paginate(9);
        
        return view('gallery.index', compact('galleries'));
    }

    /**
     * Show a specific gallery album.
     */
    public function galleryShow(string $slug): View
    {
        $gallery = Gallery::published()->where('slug', $slug)->firstOrFail();
        $gallery->load('items');

        return view('gallery.show', compact('gallery'));
    }

    /**
     * Show the donation information page.
     */
    public function donation(): View
    {
        $donationSettings = SiteSetting::getGroup('donation');
        
        return view('donation', compact('donationSettings'));
    }

    /**
     * Show the contact page.
     */
    public function contact(): View
    {
        $contactSettings = SiteSetting::getGroup('contact');
        
        return view('contact', compact('contactSettings'));
    }
}
