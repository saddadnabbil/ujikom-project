<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeminjamanShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_pinjam'      => $this->id_pinjam,
            'lama_pinjam'    => $this->lama_pinjam,
            'nominal_denda'  => $this->nominal_denda,
            'id_anggota'     => $this->id_anggota,
            'id_denda'       => $this->id_denda,
            'id_user'        => $this->id_user,
        ];
    }
}
