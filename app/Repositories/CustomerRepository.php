<?php

namespace App\Repositories;

use App\Contracts\ProdukInterface;
use App\Models\Customer;
use App\Models\Produk;

class CustomerRepository implements ProdukInterface
{
    public function __construct(
        private Customer $model
    ) {}

    public function countAll(): int
    {
        return $this->model->count();
    }
}
