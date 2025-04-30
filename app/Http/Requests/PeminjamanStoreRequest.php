<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pinjam'     => ['required', 'string', 'max:255'],
            'lama_pinjam'   => ['required', 'integer', 'min:1'],
            'nominal_denda' => ['nullable', 'numeric'],
            'id_anggota'    => ['required', 'exists:anggotas,id'],
            'id_denda'      => ['nullable', 'exists:dendas,id'],
            'id_user'       => ['nullable', 'exists:users,id'],
        ];
    }
}
