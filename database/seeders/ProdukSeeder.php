<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::insert([
            [
                'kode' => 'PRD001',
                'nama' => 'Roti Bakar',
                'harga' => 15000,
                'stok' => 100,
                'rating' => 5,
                'min_stok' => 10,
                'jenis_produk_id' => 1, // pastikan id sesuai data di JenisProdukSeeder
                'deskripsi' => 'Roti bakar lezat dengan topping coklat.'
            ],
            [
                'kode' => 'PRD002',
                'nama' => 'Teh Manis',
                'harga' => 5000,
                'stok' => 200,
                'rating' => 4,
                'min_stok' => 20,
                'jenis_produk_id' => 2,
                'deskripsi' => 'Teh manis segar.'
            ],
        ]);
    }
}
