<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnggotaShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_anggota'    => $this->id_anggota,
            'nama'          => $this->nama,
            'alamat'        => $this->alamat,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_telp'       => $this->no_telp,
            'tgl_lahir'     => $this->tgl_lahir,
            'created_at'    => $this->created_at->toDateTimeString(),
            'updated_at'    => $this->updated_at->toDateTimeString(),
        ];
    }
}
