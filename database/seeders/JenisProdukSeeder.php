<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisProduk;

class JenisProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisProduk::insert([
            ['nama' => 'Makanan'],
            ['nama' => 'Minuman'],
            ['nama' => 'Snack'],
        ]);
    }
}
