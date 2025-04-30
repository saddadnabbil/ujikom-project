<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Create 20 anggota
        for ($i = 1; $i <= 20; $i++) {
            $anggotaId = 'AGT' . str_pad($i, 3, '0', STR_PAD_LEFT);
            DB::table('anggotas')->insert([
                'id_anggota' => $anggotaId,
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'no_telp' => $faker->phoneNumber,
                'tgl_lahir' => $faker->date('Y-m-d', '-10 years'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
