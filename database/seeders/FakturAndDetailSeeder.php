<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FakturAndDetailSeeder extends Seeder
{
    /**
     * Run the database seeds for both fakturs and detail_fakturs.
     */
    public function run(): void
    {
        // First seed the fakturs
        $fakturs = [
            [
                'no_faktur' => 'INV-2025-0001',
                'tanggal_faktur' => Carbon::now()->subDays(15),
                'due_date' => Carbon::now()->addDays(15),
                'metode_bayar' => 'Transfer',
                'ppn' => 11,
                'dp' => 500000.00,
                'total' => 10000000.00,
                'grand_total' => 10600000.00,
                'customer_id' => 1,
                'perusahaan_id' => 1,
                'user_id' => null, // Setting to null
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0002',
                'tanggal_faktur' => Carbon::now()->subDays(10),
                'due_date' => Carbon::now()->addDays(20),
                'metode_bayar' => 'Cash',
                'ppn' => 11,
                'dp' => 0.00,
                'total' => 8000000.00,
                'grand_total' => 8880000.00,
                'customer_id' => 2,
                'perusahaan_id' => 2,
                'user_id' => null, // Setting to null
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0003',
                'tanggal_faktur' => Carbon::now()->subDays(5),
                'due_date' => Carbon::now()->addDays(25),
                'metode_bayar' => 'Transfer',
                'ppn' => 11,
                'dp' => 1000000.00,
                'total' => 12000000.00,
                'grand_total' => 12320000.00,
                'customer_id' => 3,
                'perusahaan_id' => 1,
                'user_id' => null, // Setting to null
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0004',
                'tanggal_faktur' => Carbon::now()->subDays(2),
                'due_date' => Carbon::now()->addDays(30),
                'metode_bayar' => 'Tempo',
                'ppn' => 11,
                'dp' => 200000.00,
                'total' => 5000000.00,
                'grand_total' => 5350000.00,
                'customer_id' => 4,
                'perusahaan_id' => 3,
                'user_id' => null, // Setting to null
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0005',
                'tanggal_faktur' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(30),
                'metode_bayar' => 'Transfer',
                'ppn' => 11,
                'dp' => 300000.00,
                'total' => 7000000.00,
                'grand_total' => 7470000.00,
                'customer_id' => 5,
                'perusahaan_id' => 4,
                'user_id' => null, // Setting to null
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('fakturs')->insert($fakturs);

        // Then seed the detail_fakturs
        $detailFakturs = [
            [
                'no_faktur' => 'INV-2025-0001',
                'id_produk' => 1,
                'qty' => 2,
                'price' => 3000000.00,
                'subtotal' => 6000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0001',
                'id_produk' => 3,
                'qty' => 4,
                'price' => 1000000.00,
                'subtotal' => 4000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0002',
                'id_produk' => 2,
                'qty' => 2,
                'price' => 4000000.00,
                'subtotal' => 8000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0003',
                'id_produk' => 1,
                'qty' => 3,
                'price' => 4000000.00,
                'subtotal' => 12000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0004',
                'id_produk' => 4,
                'qty' => 2,
                'price' => 1500000.00,
                'subtotal' => 3000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0004',
                'id_produk' => 5,
                'qty' => 1,
                'price' => 2000000.00,
                'subtotal' => 2000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0005',
                'id_produk' => 2,
                'qty' => 1,
                'price' => 4000000.00,
                'subtotal' => 4000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_faktur' => 'INV-2025-0005',
                'id_produk' => 3,
                'qty' => 3,
                'price' => 1000000.00,
                'subtotal' => 3000000.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('detail_fakturs')->insert($detailFakturs);
    }
}
