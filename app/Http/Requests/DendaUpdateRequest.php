<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DendaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nominal' => ['required', 'numeric'],
        ];
    }
}
