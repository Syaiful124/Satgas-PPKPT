<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Ketua',
            'email' => 'syaiful_22310001@stimata.ac.id',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Pelapor',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Kategori::create(['nama_kategori' => 'Kekerasan / Pelecehan Seksual']);
        Kategori::create(['nama_kategori' => 'Perundungan (Bullying)']);
        Kategori::create(['nama_kategori' => 'Penyalahgunaan Nafsa']);
        Kategori::create(['nama_kategori' => 'Lainnya']);
    }
}
