<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

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

    /*
    |--------------------------------------------------------------------------
    | FUNGSI UNTUK PUBLIC / USER
    |--------------------------------------------------------------------------
    */
    public function createPublic()
    {
        $kategoris = Kategori::all();
        return view('public.kirim_pengaduan', compact('kategoris'));
    }

    public function storePublic(Request $request)
    {
        $request->validate([
            'anonim' => 'nullable|boolean',
            'nama_pelapor' => 'required_if:anonim,false|string|max:255',
            'email_pelapor' => 'nullable|email',
            'telepon_pelapor' => 'nullable|string|max:15',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isi_laporan' => 'required|string',
            'foto_kejadian' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,mov|max:20480', // 20MB max
            'persetujuan' => 'required',
        ]);

        $path = null;
        if ($request->hasFile('foto_kejadian')) {
            $path = $request->file('foto_kejadian')->store('public/kejadian');
        }

        $namaPelapor = 'Anonim';
        if (Auth::check() && !$request->filled('anonim')) {
            $namaPelapor = Auth::user()->name;
        } elseif (!$request->filled('anonim')) {
            $namaPelapor = $request->nama_pelapor;
        }

        Pengaduan::create([
            'user_id' => Auth::id(), // Akan null jika tamu
            'nama_pelapor' => $namaPelapor,
            'email_pelapor' => Auth::check() ? Auth::user()->email : $request->email_pelapor,
            'telepon_pelapor' => $request->telepon_pelapor,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'isi_laporan' => $request->isi_laporan,
            'foto_kejadian' => $path,
            'status' => 'menunggu',
        ]);

        return redirect()->route('beranda')->with('success', 'Pengaduan Anda telah berhasil dikirim. Terima kasih.');
    }

    // Menampilkan detail pengaduan milik user
    public function showUser(Pengaduan $pengaduan)
    {
        // Pastikan user hanya bisa melihat laporannya sendiri
        if (Gate::denies('view', $pengaduan)) {
            abort(403);
        }
        return view('user.detail_pengaduan', compact('pengaduan'));
    }

    // Menampilkan form edit pengaduan milik user
    public function editUser(Pengaduan $pengaduan)
    {
        // Pastikan user hanya bisa mengedit laporannya sendiri & statusnya 'menunggu'
        if (Gate::denies('update', $pengaduan)) {
            abort(403, 'Anda tidak dapat mengedit laporan ini.');
        }
        $kategoris = Kategori::all();
        return view('user.edit_pengaduan', compact('pengaduan', 'kategoris'));
    }

    // Proses update pengaduan oleh user
    public function updateUser(Request $request, Pengaduan $pengaduan)
    {
        if (Gate::denies('update', $pengaduan)) {
            abort(403);
        }

        // Validasi sama seperti storePublic, tapi beberapa field mungkin tidak perlu
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'isi_laporan' => 'required|string',
        ]);

        $pengaduan->update($request->only(['judul', 'kategori_id', 'isi_laporan']));

        return redirect()->route('account.pengaduan.show', $pengaduan)->with('success', 'Laporan berhasil diperbarui.');
    }

    // Proses hapus pengaduan oleh user
    public function destroyUser(Pengaduan $pengaduan)
    {
        if (Gate::denies('delete', $pengaduan)) {
            abort(403);
        }

        // Hapus file jika ada
        if ($pengaduan->foto_kejadian) {
            Storage::delete($pengaduan->foto_kejadian);
        }
        $pengaduan->delete();

        return redirect()->route('account.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
