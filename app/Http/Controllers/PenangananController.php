<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Penanganan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenangananController extends Controller
{
    public function store(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'isi_penanganan' => 'required|string',
            'foto_penanganan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // max 5MB
        ]);

        $path = null;
        if ($request->hasFile('foto_penanganan')) {
            $path = $request->file('foto_penanganan')->store('public/penanganan');
        }

        Penanganan::updateOrCreate(
            ['pengaduan_id' => $pengaduan->id],
            [
                'admin_id' => Auth::id(),
                'isi_penanganan' => $request->isi_penanganan,
                'foto_penanganan' => $path,
            ]
        );

        // Status pengaduan tetap 'penanganan', superadmin yang akan mengubahnya menjadi 'selesai'
        return redirect()->route('admin.laporan.masuk')->with('success', 'Laporan penanganan berhasil dikirim.');
    }
}
