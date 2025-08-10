<?php

namespace App\Http\Controllers;

use App\Models\Unduhan;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function beranda()
    {
        return view('public.beranda');
    }

    public function unduhan()
    {
        $files = Unduhan::all();
        // Anda perlu mengisi data unduhan, misalnya melalui seeder atau fitur admin
        // Contoh data dummy jika tabel kosong:
        if ($files->isEmpty()) {
            $files = collect([
                (object)['judul' => 'Undang-Undang RI No 12 Tahun 2022', 'file_path' => '#', 'file_name' => 'UU_TPKS.pdf'],
                (object)['judul' => 'Permendikbudristek No 30 Tahun 2021', 'file_path' => '#', 'file_name' => 'Permen_PPKS.pdf'],
            ]);
        }
        return view('public.unduhan', compact('files'));
    }

    public function hubungiKami()
    {
        return view('public.hubungi_kami');
    }
}
