<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukEditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_produk'    => $this->id_produk,
            'nama_produk'  => $this->nama_produk,
            'price'        => $this->price,
            'jenis'        => $this->jenis,
            'stock'        => $this->stock,
        ];
    }
}
