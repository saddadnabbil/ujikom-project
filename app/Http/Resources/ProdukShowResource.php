<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_produk'    => $this->id_produk,
            'nama_produk'  => $this->nama_produk,
            'price'        => $this->price,
            'jenis'        => $this->jenis,
            'stock'        => $this->stock,
            'created_at'   => $this->created_at->toDateTimeString(),
            'updated_at'   => $this->updated_at->toDateTimeString(),
        ];
    }
}
