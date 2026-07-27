<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'description' => ['nullable', 'string', 'max:1000'],
            'date' => ['required', 'date'],
            'status' => ['required', 'in:rencana,terlaksana'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul pengeluaran wajib diisi.',
            'amount.required' => 'Jumlah pengeluaran wajib diisi.',
            'amount.min' => 'Jumlah pengeluaran minimal Rp 1.',
            'date.required' => 'Tanggal pengeluaran wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status harus Rencana atau Terlaksana.',
        ];
    }
}
