<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'date' => ['required', 'date'],
            'is_anonymous' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama donatur wajib diisi.',
            'amount.required' => 'Jumlah donasi wajib diisi.',
            'amount.min' => 'Jumlah donasi minimal Rp 1.',
            'date.required' => 'Tanggal donasi wajib diisi.',
        ];
    }
}
