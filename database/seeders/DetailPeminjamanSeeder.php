<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DetailPeminjamanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $peminjamanIds = DB::table('peminjamen')->pluck('id')->toArray();
        $bukuIds = DB::table('bukus')->pluck('id')->toArray();

        // Each peminjaman will have 1-3 books
        foreach ($peminjamanIds as $peminjamanId) {
            $numBooks = rand(1, 3);
            $selectedBooks = $faker->randomElements($bukuIds, $numBooks);

            foreach ($selectedBooks as $bukuId) {
                // Get peminjaman date
                $peminjamanDate = DB::table('peminjamen')
                    ->where('id_pinjam', $peminjamanId)
                    ->value('created_at');

                // Set return date (7-14 days from peminjaman date)
                $returnDate = Carbon::parse($peminjamanDate)->addDays(rand(7, 14))->format('Y-m-d');

                DB::table('detail_pinjams')->insert([
                    'id_pinjam' => $peminjamanId,
                    'id_buku' => $bukuId,
                    'tgl_kembali' => $returnDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
