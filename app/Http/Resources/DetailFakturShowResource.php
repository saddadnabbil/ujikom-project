<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailFakturShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'faktur_id' => $this->faktur_id,
            'produk' => $this->produk->nama_produk ?? null, // Assuming 'nama_produk' is a field in the Produk model
            'jumlah' => $this->jumlah,
            'harga_satuan' => $this->harga_satuan,
            'subtotal' => $this->subtotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
