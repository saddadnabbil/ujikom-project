<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailFakturUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ];
    }
}
