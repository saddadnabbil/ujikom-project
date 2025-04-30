<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DendaShowResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'nominal'         => $this->nominal,
        ];
    }
}
