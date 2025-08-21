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
        $files = Unduhan::latest()->get();

        return view('public.unduhan', compact('files'));
    }

    public function hubungiKami()
    {
        return view('public.hubungi_kami');
    }
}
