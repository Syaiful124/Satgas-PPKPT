<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function penugasan(Pengaduan $pengaduan)
    {
        $pengaduan->load('kategori', 'petugas');

        if (!$pengaduan->petugas) {
            return redirect()->back()->with('error', 'Laporan ini belum ditugaskan ke petugas manapun.');
        }

        return view('print.surat_penugasan', compact('pengaduan'));
    }
}
