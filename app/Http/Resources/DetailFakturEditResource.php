<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailFakturEditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'faktur_id' => $this->faktur_id,
            'produk_id' => $this->produk_id, // Include product ID for editing
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'subtotal' => $this->subtotal,
        ];
    }
}
