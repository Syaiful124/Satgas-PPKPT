<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\Pendampingan;
use App\Models\Tindaklanjut;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Kategori::create(['nama_kategori' => 'Kekerasan / Pelecehan Seksual']);
        Kategori::create(['nama_kategori' => 'Perundungan (Bullying)']);
        Kategori::create(['nama_kategori' => 'Penyalahgunaan Nafsa']);
        Kategori::create(['nama_kategori' => 'Lainnya']);

        Pendampingan::create(['opsi_pendampingan' => 'Psikologis']);
        Pendampingan::create(['opsi_pendampingan' => 'Hukum']);
        Pendampingan::create(['opsi_pendampingan' => 'Medis']);

        Tindaklanjut::create(['opsi_tindaklanjut' => 'Sanksi']);
        Tindaklanjut::create(['opsi_tindaklanjut' => 'Tindakan Administratif']);
        Tindaklanjut::create(['opsi_tindaklanjut' => 'Penerusan ke Hukum']);

        $this->call([
            UnduhanSeeder::class,
        ]);
        
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

    }
}
