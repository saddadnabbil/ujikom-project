<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $kategoriIds = DB::table('kategoris')->pluck('id')->toArray();

        // Create 50 books
        for ($i = 1; $i <= 50; $i++) {
            $year = $faker->numberBetween(1990, 2023);
            DB::table('bukus')->insert([
                'judul' => $faker->sentence(3),
                'pengarang' => $faker->name,
                'penerbit' => $faker->company,
                'tahun' => $year,
                'isbn' => $faker->numerify('###'),
                'jml_halaman' => $faker->numberBetween(1, 10),
                'tgl_input' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'id_kategori' => $faker->randomElement($kategoriIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
