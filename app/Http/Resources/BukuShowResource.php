<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BukuShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'judul'         => $this->judul,
            'pengarang'     => $this->pengarang,
            'penerbit'      => $this->penerbit,
            'tahun'         => $this->tahun,
            'isbn'          => $this->isbn,
            'tgl_input'     => $this->tgl_input,
            'jml_halaman'   => $this->jml_halaman,
            'id_kategori'   => $this->id_kategori,
            'created_at'   => $this->created_at->toDateTimeString(),
            'updated_at'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
