<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Andri Prasetyo,SE., MMSI',
            'email' => 'andri@stimata.ac.id',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Syaiful Ma\'arif',
            'email' => 'syaiful_22310001@stimata.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Syaiful',
            'email' => 'syaiful@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Kategori::create(['nama_kategori' => 'Kekerasan / Pelecehan Seksual']);
        Kategori::create(['nama_kategori' => 'Perundungan (Bullying)']);
        Kategori::create(['nama_kategori' => 'Penyalahgunaan Nafsa']);
        Kategori::create(['nama_kategori' => 'Lainnya']);


        $this->call([
            UnduhanSeeder::class,
        ]);
    }
}
