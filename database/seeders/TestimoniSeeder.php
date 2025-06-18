<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimoni;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimoni::insert([
            [
                'tanggal' => now(),
                'nama_tokoh' => 'Budi',
                'komentar' => 'Roti bakarnya enak!',
                'rating' => 5,
                'produk_id' => 1, // pastikan id produk sesuai ProdukSeeder
                'kategori_tokoh_id' => 1, // pastikan id kategori sesuai KategoriTokohSeeder
            ],
            [
                'tanggal' => now(),
                'nama_tokoh' => 'Siti',
                'komentar' => 'Teh manisnya segar.',
                'rating' => 4,
                'produk_id' => 2,
                'kategori_tokoh_id' => 2,
            ],
        ]);
    }
}
