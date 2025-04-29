<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_produk' => ['required', 'min:3', 'max:191'],
            'price'       => ['required', 'numeric', 'min:0'],
            'jenis'       => ['required', 'string', 'max:100'],
            'stock'       => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi!',
            'nama_produk.min'      => 'Nama produk minimal :min karakter!',
            'nama_produk.max'      => 'Nama produk maksimal :max karakter!',
            'price.required'       => 'Harga produk wajib diisi!',
            'price.numeric'        => 'Harga produk harus berupa angka!',
            'jenis.required'       => 'Jenis produk wajib diisi!',
            'jenis.string'         => 'Jenis produk harus berupa teks!',
            'stock.required'       => 'Stok produk wajib diisi!',
            'stock.integer'        => 'Stok produk harus berupa angka bulat!',
            'stock.min'            => 'Stok tidak boleh kurang dari :min!',
        ];
    }
}
