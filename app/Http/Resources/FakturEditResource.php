<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FakturEditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'no_faktur' => $this->no_faktur,
            'customer_id' => $this->customer_id,
            'perusahaan_id' => $this->perusahaan_id,
            'tanggal_faktur' => $this->tanggal_faktur,
            'due_date' => $this->due_date,
            'metode_bayar' => $this->metode_bayar,
            'ppn' => $this->ppn,
            'dp' => $this->dp,
            'total' => $this->total,
            'grand_total' => $this->grand_total,
            'details' => $this->detailFakturs->map(function ($detail) {
                return [
                    'produk_id' => $detail->produk_id,
                    'jumlah' => $detail->jumlah,
                    'harga_satuan' => $detail->harga_satuan,
                    'subtotal' => $detail->subtotal,
                ];
            }),
        ];
    }
}
