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
            'due_date' => 'required|date',
            'metode_bayar' => 'required|string',
            'ppn' => 'required|numeric',
            'dp' => 'required|numeric',
            'total' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'details' => 'required|array|min:1', // Ensure at least one detail
            'details.*.id_produk' => 'required|exists:produks,id_produk', // Validate product ID
            'details.*.qty' => 'required|integer|min:1', // Validate quantity
            'details.*.price' => 'required|numeric|min:0', // Validate price
            'details.*.subtotal' => 'nullable|numeric|min:0', // Optional subtotal validation
        ];
    }
}
