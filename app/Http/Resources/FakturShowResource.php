<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FakturShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'no_faktur' => $this->no_faktur,
            'customer' => $this->customer->nama_customer ?? null,
            'perusahaan' => $this->perusahaan->nama_perusahaan ?? null,
            'tanggal_faktur' => $this->tanggal_faktur,
            'due_date' => $this->due_date,
            'metode_bayar' => $this->metode_bayar,
            'ppn' => $this->ppn,
            'dp' => $this->dp,
            'total' => $this->total,
            'grand_total' => $this->grand_total,
            'details' => $this->detailFakturs->map(function ($detail) {
                return [
                    'no_faktur' => $this->no_faktur,
                    'produk' => $detail->produk->nama_produk,
                    'jumlah' => $detail->qty,
                    'harga_satuan' => $detail->produk->price,
                    'subtotal' => $detail->qty * $detail->produk->price,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
