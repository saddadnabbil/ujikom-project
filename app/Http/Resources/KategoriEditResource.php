<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriEditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'kategori_buku'         => $this->kategori_buku,
        ];
    }
}
