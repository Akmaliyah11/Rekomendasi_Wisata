<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Kategori
        DB::table('categories')->insert([
            ['nama' => 'Pantai'],
            ['nama' => 'Pegunungan'],
            ['nama' => 'Sejarah'],
            ['nama' => 'Kuliner']
        ]);

        // Destinasi
        DB::table('destinations')->insert([
            ['nama' => 'Pantai Alam Indah', 'deskripsi' => 'Pantai populer di Tegal', 'lokasi' => 'Tegal', 'kategori_id' => 1, 'gambar' => 'pantai_alam.jpg'],
            ['nama' => 'Guci Hot Waterboom', 'deskripsi' => 'Pemandian air panas di lereng gunung Slamet', 'lokasi' => 'Tegal', 'kategori_id' => 2, 'gambar' => 'guci.jpg']
        ]);

        // User Preferences
        DB::table('user_preferences')->insert([
            ['user_id' => 1, 'kategori_id' => 1],
            ['user_id' => 1, 'kategori_id' => 2]
        ]);

        // Reviews
        DB::table('reviews')->insert([
            ['user_id' => 1, 'destinasi_id' => 1, 'rating' => 4.5, 'review' => 'Pantainya bersih dan indah'], 
            ['user_id' => 1, 'destinasi_id' => 2, 'rating' => 5, 'review' => 'Air panasnya menyegarkan!']
        ]);
    }
}
