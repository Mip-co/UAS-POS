<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus semua user terlebih dahulu (hati-hati di production)
        User::query()->delete();

        // Buat user admin
        User::factory()->create([
            'name' => 'Admin POS',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        // Buat user manager
        User::factory()->create([
            'name' => 'Manager POS',
            'email' => 'manager@gmail.com',
            'role' => 'manager',
            'password' => bcrypt('manager123'),
        ]);
    }
}
