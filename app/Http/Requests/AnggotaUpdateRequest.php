<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnggotaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'no_telp' => ['required', 'string', 'max:15'],
            'tgl_lahir' => ['required', 'date'],
        ];
    }
}
