<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_produk' => ['required', 'min:3', 'max:191'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi!',
            'nama_produk.min' => 'Nama produk minimal :min karakter!',
            'nama_produk.max' => 'Nama produk maksimal :max karakter!',
            'price.required' => 'Harga produk wajib diisi!',
            'price.numeric' => 'Harga produk harus berupa angka!',
        ];
    }
}
