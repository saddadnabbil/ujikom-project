<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = [
            [
                'nama_produk' => 'Laptop Asus ROG',
                'price' => 15000000.00,
                'jenis' => 'Elektronik',
                'stock' => 25,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'Samsung Galaxy S22',
                'price' => 12000000.00,
                'jenis' => 'Smartphone',
                'stock' => 50,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'Printer Epson L3110',
                'price' => 2500000.00,
                'jenis' => 'Elektronik',
                'stock' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'Meja Kerja',
                'price' => 1500000.00,
                'jenis' => 'Furniture',
                'stock' => 15,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_produk' => 'Kursi Gaming',
                'price' => 2000000.00,
                'jenis' => 'Furniture',
                'stock' => 20,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('produks')->insert($produks);
    }
}
