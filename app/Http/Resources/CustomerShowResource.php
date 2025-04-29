<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_customer' => $this->nama_customer, // Name of the customer
            'perusahaan_cust' => $this->perusahaan_cust, // Company name
            'alamat' => $this->alamat, // Address
            'created_at' => $this->created_at, // Created at timestamp
            'updated_at' => $this->updated_at, // Updated at timestamp
        ];
    }
}
