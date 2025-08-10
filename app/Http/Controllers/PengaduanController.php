<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    // === UNTUK SUPERADMIN ===

    public function laporanMasukSuperAdmin(Request $request)
    {
        $query = Pengaduan::with('kategori')
            ->whereIn('status', ['menunggu', 'penanganan']);

        // Implementasi search dan filter serupa dengan dashboard
        if ($request->filled('search')) {
             $query->where('judul', 'like', '%' . $request->search . '%');
        }
        // ... tambahkan filter lainnya jika perlu ...

        $pengaduans = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        return view('superadmin.laporan_masuk', compact('pengaduans', 'kategoris'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load('kategori', 'user', 'penanganan.admin');
        // Arahkan ke view yang sesuai berdasarkan status
        if($pengaduan->status == 'menunggu'){
            return view('superadmin.detail_menunggu', compact('pengaduan'));
        } elseif ($pengaduan->status == 'penanganan' || $pengaduan->status == 'selesai') {
            return view('superadmin.detail_penanganan', compact('pengaduan'));
        } elseif ($pengaduan->status == 'ditolak') {
             return view('superadmin.detail_ditolak', compact('pengaduan'));
        }
    }

    public function setujuiPenanganan(Request $request, Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'penanganan']);
        return redirect()->route('superadmin.laporan.masuk')->with('success', 'Pengaduan disetujui untuk ditangani.');
    }

    public function tolakPengaduan(Request $request, Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'ditolak']);
        return redirect()->route('superadmin.dashboard')->with('success', 'Pengaduan telah ditolak.');
    }

    public function selesaikanPengaduan(Request $request, Pengaduan $pengaduan)
    {
        $pengaduan->update(['status' => 'selesai']);
        return redirect()->route('superadmin.dashboard')->with('success', 'Pengaduan telah diselesaikan.');
    }

    public function laporanSelesai(Request $request)
    {
        $pengaduans = Pengaduan::with('kategori')->where('status', 'selesai')->latest()->paginate(10);
        return view('superadmin.laporan_selesai', compact('pengaduans'));
    }

    public function laporanDitolak(Request $request)
    {
        $pengaduans = Pengaduan::with('kategori')->where('status', 'ditolak')->latest()->paginate(10);
        return view('superadmin.laporan_ditolak', compact('pengaduans'));
    }


    // === UNTUK ADMIN ===

    public function laporanMasukAdmin(Request $request)
    {
        // Admin hanya melihat laporan berstatus 'penanganan'
        $query = Pengaduan::with('kategori')->where('status', 'penanganan');

        // ... tambahkan search & filter jika diperlukan di halaman admin ...

        $pengaduans = $query->latest()->paginate(10);
        return view('admin.laporan_masuk', compact('pengaduans'));
    }

    public function showAdmin(Pengaduan $pengaduan)
    {
        // Memastikan admin hanya bisa membuka laporan berstatus penanganan
        if($pengaduan->status !== 'penanganan'){
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }
        $pengaduan->load('kategori', 'user');
        return view('admin.detail_penanganan', compact('pengaduan'));
    }

    // === FITUR PRINT (CONTOH SEDERHANA) ===
    public function print(Request $request)
    {
        $ids = $request->input('ids');
        if(!$ids){
            return back()->with('error', 'Pilih setidaknya satu laporan untuk dicetak.');
        }
        $pengaduans = Pengaduan::with('kategori', 'penanganan.admin')->whereIn('id', $ids)->get();
        // Disini Anda bisa membuat view khusus untuk cetak
        return view('print.laporan', compact('pengaduans'));
    }
}
