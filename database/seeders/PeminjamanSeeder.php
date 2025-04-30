<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PeminjamanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $anggotaIds = DB::table('anggotas')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();
        $dendaIds = DB::table('dendas')->pluck('id')->toArray();

        // Create 30 peminjaman records
        for ($i = 1; $i <= 30; $i++) {
            $pinjamId = 'PJM' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $anggotaId = $faker->randomElement($anggotaIds);

            DB::table('peminjamen')->insert([
                'id_pinjam' => $pinjamId,
                'lama_pinjam' => '1 Minggu',
                'nominal_denda' => 5000.00, // Default denda
                'id_anggota' => $anggotaId,
                'id_denda' => $faker->randomElement($dendaIds),
                'id_user' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
