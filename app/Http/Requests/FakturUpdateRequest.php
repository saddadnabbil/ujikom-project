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
            'total' => 'required|numeric|min:0',
        ];
    }
}
