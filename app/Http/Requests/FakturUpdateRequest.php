<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FakturUpdateRequest extends FormRequest
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
            'due_date' => 'required|date',
            'metode_bayar' => 'required|string',
            'ppn' => 'nullable|numeric|min:0',
            'dp' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
            'details' => 'required|array|min:1',
            'details.*.id_produk' => 'required|exists:produks,id_produk',
            'details.*.qty' => 'required|integer|min:1',
            'details.*.price' => 'required|numeric|min:0',
            'details.*.subtotal' => 'nullable|numeric|min:0',
        ];
    }
}
