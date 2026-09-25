<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengembalianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'peminjaman_id' => 'required|exists:peminjaman,id',
            'tanggal_kembali' => 'required|date',
            'denda' => 'required|numeric|min:0',
        ];
    }
}