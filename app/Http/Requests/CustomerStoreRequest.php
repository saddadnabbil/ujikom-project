<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_customer' => 'required|string|max:255', // Name of the customer is required
            'perusahaan_cust' => 'required|string|max:255', // Company name is required
            'alamat' => 'nullable|string|max:500', // Address is optional but can be up to 500 characters
        ];
    }
}
