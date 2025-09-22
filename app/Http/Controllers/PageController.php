<?php

namespace App\Http\Controllers;

use App\Models\Unduhan;
use Illuminate\Http\Request;
use App\Models\BuktiPenanganan;
use App\Models\Penanganan;
use Illuminate\View\View;
use App\Models\User;

class PageController extends Controller
{
    public function beranda()
    {
        $penangananIds = Penanganan::whereHas('pengaduan', function ($query) {
                $query->where('status', 'selesai');
            })
            ->whereHas('bukti', function ($query) {
                $query->where('file_type', 'video');
            })
            ->latest('updated_at')
            ->limit(6)
            ->pluck('id');

        $galeriItems = BuktiPenanganan::whereIn('penanganan_id', $penangananIds)
            ->where('file_type', 'video')
            ->latest()
            ->get()
            ->unique('penanganan_id');

        $superadmins = User::where('role', 'superadmin')->orderBy('id', 'asc')->get();
        $ketua = $superadmins->first();
        $sekretaris = $superadmins->get(1);
        $anggotas = User::where('role', 'admin')->get();

        return view('public.beranda', compact('galeriItems', 'ketua', 'sekretaris', 'anggotas'));
    }

    public function unduhan()
    {
        $files = Unduhan::latest()->get();

        return view('public.unduhan', compact('files'));
    }

    public function hubungiKami()
    {
        return view('public.hubungi_kami');
    }
}
