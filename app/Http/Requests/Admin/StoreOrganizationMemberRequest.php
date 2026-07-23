<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'parent_id' => ['nullable', 'integer', 'exists:organization_members,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'level' => ['nullable', 'integer', 'min:0', 'max:10'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama anggota wajib diisi.',
            'position.required' => 'Jabatan wajib diisi.',
            'photo.image' => 'Foto harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
            'parent_id.exists' => 'Atasan yang dipilih tidak valid.',
        ];
    }
}
