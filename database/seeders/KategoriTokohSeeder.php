<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriTokoh;

class KategoriTokohSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriTokoh::insert([
            ['nama' => 'Kasir'],
            ['nama' => 'Gudang'],
            ['nama' => 'Admin'],
        ]);
    }
}
