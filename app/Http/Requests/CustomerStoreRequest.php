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
            'nama_customer' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'no_telp' => 'required|string|max:15',
            'alamat' => 'nullable|string|max:500',
        ];
    }
}
