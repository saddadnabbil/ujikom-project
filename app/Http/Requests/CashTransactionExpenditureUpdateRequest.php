<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashTransactionExpenditureUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'student_id' => 'required',
            'expenditure' => 'required|numeric|digits_between:3,191',
            'amount' => 'required|numeric|digits_between:3,191',
            'date' => 'required|date',
            'note' => 'max:191'
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Kolom nama pelajar wajib diisi!',

            'expenditure.required' => 'Kolom Pengeluaran wajib diisi!',
            'expenditure.numeric' => 'Kolom Pengeluaran harus angka!',
            'expenditure.digits_between' => 'Kolom Pengeluaran maksimal 191 karakter!',

            'amount.required' => 'Kolom Pengeluaran wajib diisi!',
            'amount.numeric' => 'Kolom Pengeluaran harus angka!',
            'amount.digits_between' => 'Kolom Pengeluaran maksimal 191 karakter!',

            'date.required' => 'Kolom tanggal wajib diisi!',
            'date.date' => 'Kolom tanggal harus tanggal yang valid!',

            'note.max' => 'Kolom keterangan maksimal 191 karakter!'
        ];
    }
}
