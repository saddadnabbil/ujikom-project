<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['id_kategori' => 'KTG001', 'kategori_buku' => 'Fiksi'],
            ['id_kategori' => 'KTG002', 'kategori_buku' => 'Non-Fiksi'],
            ['id_kategori' => 'KTG003', 'kategori_buku' => 'Sains'],
            ['id_kategori' => 'KTG004', 'kategori_buku' => 'Teknologi'],
            ['id_kategori' => 'KTG005', 'kategori_buku' => 'Sejarah'],
            ['id_kategori' => 'KTG006', 'kategori_buku' => 'Biografi'],
            ['id_kategori' => 'KTG007', 'kategori_buku' => 'Pendidikan'],
            ['id_kategori' => 'KTG008', 'kategori_buku' => 'Sastra'],
            ['id_kategori' => 'KTG009', 'kategori_buku' => 'Agama'],
            ['id_kategori' => 'KTG010', 'kategori_buku' => 'Hukum'],
        ];

        foreach ($categories as $category) {
            DB::table('kategoris')->insert([
                'id_kategori' => $category['id_kategori'],
                'kategori_buku' => $category['kategori_buku'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
