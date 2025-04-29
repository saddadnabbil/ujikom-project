<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerusahaanStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
        ];
    }
}
