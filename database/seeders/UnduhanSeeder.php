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
            'file_path' => 'https://jdih.setneg.go.id/uploads/files/4909/salinan_uu_nomor_12_tahun_2022.pdf'
        ]);

        Unduhan::create([
            'judul' => 'Satgas PPKPT di Lingkungan STMIK PPKIA Pradnya Paramita Malang',
            'file_name' => '054-2024 Satgas PPKPT.pdf',
            'file_path' => 'dokumen/054-2024 Satgas PPKPT.pdf'
        ]);

        Unduhan::create([
            'judul' => 'MEKANISME PENCEGAHAN DAN PENANGANAN KASUS KEKERASAN SEKSUAL DI PERGURUAN TINGGI',
            'file_name' => 'MEKANISME PENCEGAHAN DAN PENANGANAN KASUS KEKERASAN SEKSUAL.pdf',
            'file_path' => 'dokumen/MEKANISME PENCEGAHAN DAN PENANGANAN KASUS KEKERASAN SEKSUAL.pdf'
        ]);

    }
}
