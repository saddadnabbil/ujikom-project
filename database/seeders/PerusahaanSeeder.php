<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perusahaans = [
            [
                'nama_perusahaan' => 'PT Sukses Mandiri',
                'alamat' => 'Jl. MT Haryono No. 15, Jakarta Selatan',
                'no_telp' => '021-5553456',
                'fax' => '021-5553457',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_perusahaan' => 'PT Cipta Karya',
                'alamat' => 'Jl. Imam Bonjol No. 88, Jakarta Pusat',
                'no_telp' => '021-4442345',
                'fax' => '021-4442346',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_perusahaan' => 'PT Global Nusantara',
                'alamat' => 'Jl. Meruya Ilir No. 24, Jakarta Barat',
                'no_telp' => '021-7771234',
                'fax' => '021-7771235',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_perusahaan' => 'PT Sinar Jaya',
                'alamat' => 'Jl. Tebet Raya No. 67, Jakarta Selatan',
                'no_telp' => '021-8889876',
                'fax' => '021-8889877',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_perusahaan' => 'PT Mitra Sejahtera',
                'alamat' => 'Jl. Kelapa Gading No. 45, Jakarta Utara',
                'no_telp' => '021-6665432',
                'fax' => '021-6665433',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('perusahaans')->insert($perusahaans);
    }
}
