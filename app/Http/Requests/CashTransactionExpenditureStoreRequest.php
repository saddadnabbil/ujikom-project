<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashTransactionExpenditureStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'student_id' => ['required'],
            'expenditure' => ['required', 'integer', 'digits_between:3,191'],
            'amount' => ['required', 'integer', 'digits_between:3,191'],
            'date' => ['required', 'date'],
            'note' => ['max:191']
        ];
    }

    public function messages()
    {
        return [
            // 'student_id.required' => 'Kolom nama pelajar wajib diisi!',

            'expenditure.required' => 'Kolom Pengeluaran wajib diisi!',
            'expenditure.integer' => 'Kolom Pengeluaran harus angka!',
            'expenditure.digits_betweeen' => 'Kolom Pengeluaran harus diantara 3 sampai dengan 191 karakter!',

            'amount.required' => 'Kolom total Pengeluaran wajib diisi!',
            'amount.integer' => 'Kolom total Pengeluaran harus angka!',
            'amount.digits_betweeen' => 'Kolom total Pengeluaran harus diantara 3 sampai dengan 191 karakter!',

            'date.required' => 'Kolom tanggal wajib diisi!',
            'date.date' => 'Kolom tanggal harus tanggal yang benar!',

            'note.max' => 'Kolom catatan maksimal 191 karakter!'
        ];
    }
}
