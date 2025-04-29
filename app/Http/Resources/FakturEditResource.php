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
                    'id_produk' => $detail->id_produk,
                    'jumlah' => $detail->qty,
                    'harga_satuan' => $detail->price,
                    'subtotal' => $detail->price,
                ];
            }),
        ];
    }
}
