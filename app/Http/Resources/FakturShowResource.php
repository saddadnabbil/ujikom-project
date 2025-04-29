<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FakturShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer->nama_customer ?? null,
            'perusahaan' => $this->perusahaan->nama_perusahaan ?? null,
            'tanggal_faktur' => $this->tanggal_faktur,
            'total' => $this->total,
            'detail_fakturs' => $this->detailFakturs->map(function ($detail) {
                return [
                    'id' => $detail->id,
                    'produk' => $detail->produk->nama_produk ?? null,
                    'jumlah' => $detail->jumlah,
                    'harga' => $detail->harga,
                    'subtotal' => $detail->subtotal,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
