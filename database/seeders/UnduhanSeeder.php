<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unduhan;

class UnduhanSeeder extends Seeder
{
    public function run(): void
    {
        Unduhan::truncate();

        Unduhan::create([
            'judul' => 'Undang-Undang Tindak Pidana Kekerasan Seksual',
            'file_name' => 'UU-No-12-Tahun-2022-Tindak-Pidana-Kekerasan-Seksual.pdf',
            'file_path' => 'document/UU Nomor 12 Tahun 2022.pdf'
        ]);

        Unduhan::create([
            'judul' => 'Permendikbudristek Nomor 30 Tahun 2021',
            'file_name' => 'Permendikbudristek-Nomor-30-Tahun-2021.pdf',
            'file_path' => 'document/Permendikbudristek-Nomor-30-Tahun-2021.pdf'
        ]);

        Unduhan::create([
            'judul' => 'Permendikbudristek Nomor 55 Tahun 2024',
            'file_name' => 'Permendikbudristek-no-55-tahun-2024.pdf',
            'file_path' => 'document/Permendikbudristek-no-55-tahun-2024.pdf'
        ]);

        Unduhan::create([
            'judul' => 'Paparan Sosialisasi Permendikbudristek PPKPT Puspeka',
            'file_name' => 'Paparan-Sosialisasi-Permendikbudristek-PPKPT-Puspeka.pdf',
            'file_path' => 'document/Paparan-Sosialisasi-Permendikbudristek-PPKPT-Puspeka.pdf'
        ]);

        Unduhan::create([
            'judul' => 'Buku Pedoman Pelaksanaan Permen PPKS',
            'file_name' => 'Buku-Pedoman-Pelaksanaan-Permen-PPKS.pdf',
            'file_path' => 'document/Buku-Pedoman-Pelaksanaan-Permen-PPKS.pdf'
        ]);

        Unduhan::create([
            'judul' => 'Mekanisme Pencegahan Dan Penanganan Kasus Kekerasan Seksual Di Perguruan Tinggi',
            'file_name' => 'Mekanisme-Pencegahan-Dan-Penanganan-Kasus-Kekerasan-Seksual.pdf',
            'file_path' => 'document/Mekanisme-Pencegahan-Dan-Penanganan-Kasus-Kekerasan-Seksual.pdf'
        ]);

        Unduhan::create([
            'judul' => 'SK Satgas PPKPT di Lingkungan STMIK PPKIA Pradnya Paramita Malang',
            'file_name' => '054-2024 Satgas PPKPT.pdf',
            'file_path' => 'document/054-2024 Satgas PPKPT.pdf'
        ]);
    }
}
