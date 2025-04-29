<?php

namespace App\Repositories;

use App\Contracts\ProdukInterface;
use App\Models\Produk;

class ProdukRepository implements ProdukInterface
{
    public function __construct(
        private Produk $model
    ) {}

    public function countAll(): int
    {
        return $this->model->count();
    }
}
