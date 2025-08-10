<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'total' => Pengaduan::count(),
            'masuk' => Pengaduan::where('status', 'menunggu')->count(),
            'selesai' => Pengaduan::where('status', 'selesai')->count(),
            'ditolak' => Pengaduan::where('status', 'ditolak')->count(),
        ];

        $query = Pengaduan::with('kategori');

        // Fitur Search
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        // Fitur Urutkan
        if ($request->filled('sort')) {
            $sort = explode('_', $request->sort);
            if(count($sort) == 2){
                $query->orderBy($sort[0], $sort[1]);
            }
        } else {
            $query->latest(); // Default sort
        }

        $pengaduans = $query->paginate(10);
        $kategoris = Kategori::all();

        return view('superadmin.dashboard', compact('stats', 'pengaduans', 'kategoris'));
    }
}
