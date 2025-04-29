<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'nama_customer' => 'Budi Santoso',
                'perusahaan_cust' => 'PT Maju Jaya',
                'alamat' => 'Jl. Sudirman No. 123, Jakarta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_customer' => 'Dewi Lestari',
                'perusahaan_cust' => 'CV Abadi Makmur',
                'alamat' => 'Jl. Gatot Subroto No. 45, Surabaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_customer' => 'Ahmad Fauzi',
                'perusahaan_cust' => 'PT Sentosa Digital',
                'alamat' => 'Jl. Diponegoro No. 78, Bandung',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_customer' => 'Siti Nurhayati',
                'perusahaan_cust' => 'PT Global Teknologi',
                'alamat' => 'Jl. Pahlawan No. 56, Semarang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_customer' => 'Rudi Hermawan',
                'perusahaan_cust' => 'CV Berkah Sejahtera',
                'alamat' => 'Jl. Ahmad Yani No. 90, Makassar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('customers')->insert($customers);
    }
}
