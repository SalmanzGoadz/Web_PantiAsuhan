<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOrganizationMemberRequest;
use App\Http\Requests\Admin\UpdateOrganizationMemberRequest;
use App\Models\ActivityLog;
use App\Models\OrganizationMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class OrganizationMemberController extends Controller
{
    /**
     * Display a listing of organization members.
     */
    public function index(): View
    {
        $members = OrganizationMember::with('parent')
            ->ordered()
            ->get();

        return view('admin.organization.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create(): View
    {
        $parentOptions = OrganizationMember::active()
            ->ordered()
            ->get(['id', 'name', 'position']);

        return view('admin.organization.create', compact('parentOptions'));
    }

    /**
     * Store a newly created member.
     */
    public function store(StoreOrganizationMemberRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                ->store('organization/photos', 'public');
        }

        $member = OrganizationMember::create($data);

        ActivityLog::log('created', $member, "Menambah anggota pengurus: {$member->name} ({$member->position})");

        return redirect()
            ->route('admin.organization.index')
            ->with('success', 'Anggota pengurus berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(OrganizationMember $organization): View
    {
        $member = $organization;

        $parentOptions = OrganizationMember::active()
            ->where('id', '!=', $member->id)
            ->ordered()
            ->get(['id', 'name', 'position']);

        return view('admin.organization.edit', compact('member', 'parentOptions'));
    }

    /**
     * Update the specified member.
     */
    public function update(UpdateOrganizationMemberRequest $request, OrganizationMember $organization): RedirectResponse
    {
        $member = $organization;
        $data = $request->validated();

        // Prevent circular reference
        if (isset($data['parent_id']) && $data['parent_id'] == $member->id) {
            return back()->withErrors(['parent_id' => 'Anggota tidak bisa menjadi atasan dirinya sendiri.']);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $request->file('photo')
                ->store('organization/photos', 'public');
        }

        $member->update($data);

        ActivityLog::log('updated', $member, "Mengubah anggota pengurus: {$member->name} ({$member->position})");

        return redirect()
            ->route('admin.organization.index')
            ->with('success', 'Anggota pengurus berhasil diperbarui.');
    }

    /**
     * Remove the specified member.
     */
    public function destroy(OrganizationMember $organization): RedirectResponse
    {
        $member = $organization;
        $name = $member->name;

        // Reassign children to parent's parent (or null)
        OrganizationMember::where('parent_id', $member->id)
            ->update(['parent_id' => $member->parent_id]);

        // Delete photo
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }

        ActivityLog::log('deleted', $member, "Menghapus anggota pengurus: {$name}");

        $member->delete();

        return redirect()
            ->route('admin.organization.index')
            ->with('success', 'Anggota pengurus berhasil dihapus.');
    }
}
