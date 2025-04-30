<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul'        => ['required', 'string', 'min:3', 'max:255'],
            'pengarang'    => ['required', 'string', 'max:255'],
            'penerbit'     => ['required', 'string', 'max:255'],
            'tahun'        => ['required', 'integer'],
            'isbn'         => ['required', 'string', 'max:20'],
            'jml_halaman'  => ['required', 'integer', 'min:1'],
            /*************  ✨ Windsurf Command ⭐  *************/
            /**
             * Get the validation messages for the defined validation rules.
             *
             * @return array Custom messages for validator errors.
             */

            /*******  4d1b600e-f069-4700-b22a-f3e21b224aaa  *******/
            'tgl_input'    => ['required', 'date'],
            'id_kategori'  => ['required', 'exists:kategoris,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'        => 'Judul buku wajib diisi!',
            'judul.min'             => 'Judul minimal :min karakter!',
            'judul.max'             => 'Judul maksimal :max karakter!',
            'pengarang.required'    => 'Pengarang wajib diisi!',
            'penerbit.required'     => 'Penerbit wajib diisi!',
            'tahun.required'        => 'Tahun terbit wajib diisi!',
            'tahun.integer'         => 'Tahun harus berupa angka!',
            'isbn.required'         => 'ISBN wajib diisi!',
            'jml_halaman.required'  => 'Jumlah halaman wajib diisi!',
            'jml_halaman.integer'   => 'Jumlah halaman harus berupa angka!',
            'jml_halaman.min'       => 'Jumlah halaman minimal 1!',
            'tgl_input.required'    => 'Tanggal input wajib diisi!',
            'tgl_input.date'        => 'Tanggal input tidak valid!',
            'id_kategori.required'  => 'Kategori buku wajib dipilih!',
            'id_kategori.exists'    => 'Kategori yang dipilih tidak valid!',
        ];
    }
}
