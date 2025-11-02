<?php

namespace App\Http\Controllers;

use App\Models\Unduhan;
use Illuminate\Http\Request;
use App\Models\BuktiPenanganan;
use App\Models\Penanganan;
use Illuminate\View\View;
use App\Models\User;use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function beranda()
    {
        $folderGaleri = 'galeri-satgas';

        $files = Storage::disk('public')->files($folderGaleri);

        $galeriItems = collect($files)->take(9)->map(function ($path) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $type = 'image';

            if (in_array($ext, ['mp4', 'mov', 'webm', 'ogv'])) {
                $type = 'video';
            }

            return (object) [
                'url' => Storage::url($path),
                'type' => $type,
                'caption' => 'Galeri Kegiatan Satgas PPKPT - ' . Str::title(str_replace('-', ' ', pathinfo($path, PATHINFO_FILENAME))),
            ];
        });

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
