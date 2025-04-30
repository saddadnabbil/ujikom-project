<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdministratorSeeder::class,
            AnggotaSeeder::class,
            KategoriSeeder::class,
            BukuSeeder::class,
            DendaSeeder::class,
            PeminjamanSeeder::class,
            DetailPeminjamanSeeder::class,
        ]);
    }
}
