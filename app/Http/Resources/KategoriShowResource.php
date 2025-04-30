<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KategoriShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'kategori_buku'         => $this->kategori_buku,
            'created_at'   => $this->created_at->toDateTimeString(),
            'updated_at'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
