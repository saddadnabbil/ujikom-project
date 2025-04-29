<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FakturStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'tanggal_faktur' => 'required|date',
            'total' => 'required|numeric|min:0',
            'details' => 'required|array|min:1',
            'details.*.produk_id' => 'required|exists:produks,id',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
            'details.*.subtotal' => 'required|numeric|min:0',
        ];
    }
}
