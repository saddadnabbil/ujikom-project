<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerEditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_customer' => $this->nama_customer,
            'email' => $this->email,
            'no_telp' => $this->no_telp,
            'alamat' => $this->alamat
        ];
    }
}
