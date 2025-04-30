<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DendaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Create 15 denda records
        for ($i = 1; $i <= 15; $i++) {
            DB::table('dendas')->insert([
                'nominal' => $faker->randomFloat(0, 5000, 50000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
