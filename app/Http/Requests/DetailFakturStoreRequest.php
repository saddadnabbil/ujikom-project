<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailFakturStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'faktur_id' => 'required|exists:fakturs,id', // Add this rule
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'harga_satuan' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ];
    }
}
