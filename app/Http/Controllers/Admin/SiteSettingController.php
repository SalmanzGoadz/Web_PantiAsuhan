<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    /**
     * Show the site settings form.
     */
    public function index(): View
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        // Load CMS pages
        $pageAbout = Page::findBySlug('tentang-kami');
        $pageSop = Page::findBySlug('sop-pengasuhan');
        $pageVisiMisi = Page::findBySlug('visi-misi');

        return view('admin.settings.index', compact('settings', 'pageAbout', 'pageSop', 'pageVisiMisi'));
    }

    /**
     * Update general site settings.
     */
    public function updateGeneral(Request $request): RedirectResponse
    {
        $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:1000'],
            'logo_primary' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
            'logo_secondary' => ['nullable', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2048'],
        ]);

        SiteSetting::set('site_name', $request->site_name, 'general');
        SiteSetting::set('site_description', $request->site_description, 'general');

        if ($request->hasFile('logo_primary')) {
            $oldLogo = SiteSetting::get('logo_primary');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo_primary')->store('logos', 'public');
            SiteSetting::set('logo_primary', $path, 'general');
        }

        if ($request->hasFile('logo_secondary')) {
            $oldLogo = SiteSetting::get('logo_secondary');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('logo_secondary')->store('logos', 'public');
            SiteSetting::set('logo_secondary', $path, 'general');
        }

        ActivityLog::log('updated', null, 'Memperbarui pengaturan umum situs');

        return back()->with('success', 'Pengaturan umum berhasil disimpan.');
    }

    /**
     * Update contact settings.
     */
    public function updateContact(Request $request): RedirectResponse
    {
        $request->validate([
            'address' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'whatsapp_message' => ['nullable', 'string', 'max:500'],
            'google_maps_embed' => ['nullable', 'string'],
        ]);

        SiteSetting::set('address', $request->address, 'contact');
        SiteSetting::set('phone', $request->phone, 'contact');
        SiteSetting::set('email', $request->email, 'contact');
        SiteSetting::set('whatsapp_number', $request->whatsapp_number, 'contact');
        SiteSetting::set('whatsapp_message', $request->whatsapp_message, 'contact');
        SiteSetting::set('google_maps_embed', $request->google_maps_embed, 'contact');

        ActivityLog::log('updated', null, 'Memperbarui pengaturan kontak');

        return back()->with('success', 'Pengaturan kontak berhasil disimpan.');
    }

    /**
     * Update social media settings.
     */
    public function updateSocial(Request $request): RedirectResponse
    {
        $request->validate([
            'instagram' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
        ]);

        SiteSetting::set('instagram', $request->instagram, 'social');
        SiteSetting::set('facebook', $request->facebook, 'social');
        SiteSetting::set('youtube', $request->youtube, 'social');
        SiteSetting::set('tiktok', $request->tiktok, 'social');

        ActivityLog::log('updated', null, 'Memperbarui pengaturan sosial media');

        return back()->with('success', 'Pengaturan sosial media berhasil disimpan.');
    }

    /**
     * Update donation settings.
     */
    public function updateDonation(Request $request): RedirectResponse
    {
        $request->validate([
            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_number' => ['nullable', 'string', 'max:50'],
            'bank_account_name' => ['nullable', 'string', 'max:255'],
            'qris_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ]);

        SiteSetting::set('bank_name', $request->bank_name, 'donation');
        SiteSetting::set('bank_account_number', $request->bank_account_number, 'donation');
        SiteSetting::set('bank_account_name', $request->bank_account_name, 'donation');

        if ($request->hasFile('qris_image')) {
            $oldQris = SiteSetting::get('qris_image');
            if ($oldQris) {
                Storage::disk('public')->delete($oldQris);
            }
            $path = $request->file('qris_image')->store('donation', 'public');
            SiteSetting::set('qris_image', $path, 'donation');
        }

        ActivityLog::log('updated', null, 'Memperbarui pengaturan donasi');

        return back()->with('success', 'Pengaturan donasi berhasil disimpan.');
    }

    /**
     * Update CMS pages (Tentang Kami, SOP, Visi Misi).
     */
    public function updatePage(Request $request, string $slug): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        $page = Page::updateOrCreate(
            ['slug' => $slug],
            $request->only(['title', 'content', 'meta_title', 'meta_description'])
        );

        ActivityLog::log('updated', $page, "Memperbarui halaman: {$page->title}");

        return back()->with('success', 'Halaman berhasil disimpan.');
    }

    /**
     * Update jadwal kegiatan setting.
     */
    public function updateJadwalKegiatan(Request $request): RedirectResponse
    {
        $request->validate([
            'jadwal_kegiatan' => ['nullable', 'string'],
        ]);

        SiteSetting::set('jadwal_kegiatan', $request->jadwal_kegiatan, 'general');

        ActivityLog::log('updated', null, 'Memperbarui jadwal kegiatan panti');

        return back()->with('success', 'Jadwal kegiatan berhasil disimpan.');
    }
}
