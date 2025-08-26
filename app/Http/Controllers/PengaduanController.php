<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Models\User;


class PengaduanController extends Controller
{
    // === UNTUK SUPERADMIN ===

    public function laporanMasukSuperAdmin(Request $request)
    {
        $query = Pengaduan::with('kategori')
            ->whereIn('status', ['menunggu', 'penanganan']);

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $pengaduans = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        return view('superadmin.laporan_masuk', compact('pengaduans', 'kategoris'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load('kategori', 'user', 'penanganan.admin');
        $petugas_list = User::where('role', 'admin')->get();

        return view('superadmin.detail', compact('pengaduan', 'petugas_list'));
    }

    public function setujuiPenanganan(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'petugas_id' => 'required|exists:users,id',
        ]);

        // Update status dan simpan ID petugas yang ditugaskan
        $pengaduan->update([
            'status' => 'penanganan',
            'petugas_id' => $request->petugas_id
        ]);

        // Arahkan ke halaman print surat tugas
        return redirect()->route('superadmin.surat.penugasan', $pengaduan)
                        ->with('success', 'Laporan disetujui dan surat tugas telah dibuat.');
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
        $query = Pengaduan::with('kategori')
                            ->where('status', 'penanganan')
                            ->where('petugas_id', Auth::id());

        $pengaduans = $query->latest('updated_at')->paginate(10);
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
        $lainnyaKategoriId = Kategori::where('nama_kategori', 'Lainnya')->first()?->id;
        $imageFormats = 'jpg,jpeg,png,gif,webp,heic';
        $videoFormats = 'mp4,mov,avi,mkv,webm,flv';

        $request->validate([
            'anonim' => 'nullable|boolean',
            'nama_pelapor' => [
                Rule::requiredIf(!$request->boolean('anonim') && !Auth::check()),
                'nullable', 'string', 'max:255'
            ],
            'email_pelapor' => [
                Rule::requiredIf(!$request->boolean('anonim')),
                'nullable', 'email', 'max:255'
            ],
            'telepon_pelapor' => [
                Rule::requiredIf(!$request->boolean('anonim')),
                'nullable', 'string', 'max:25'
            ],
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'kategori_lainnya' => [
                Rule::requiredIf($request->input('kategori_id') == $lainnyaKategoriId),
                'nullable', 'string', 'max:100'
            ],
            'isi_laporan' => 'required|string',
            'persetujuan' => 'required',
            'bukti' => 'nullable|array|max:6',
            'bukti.*' => [
                'file',
                'mimes:' . $imageFormats . ',' . $videoFormats,
                function ($attribute, $value, $fail) {
                    // Validasi ukuran custom
                    $maxImageSize = 10 * 1024; // 10 MB untuk gambar
                    $maxVideoSize = 300 * 1024; // 300 MB untuk video

                    $isImage = Str::startsWith($value->getMimeType(), 'image/');
                    $isVideo = Str::startsWith($value->getMimeType(), 'video/');

                    if ($isImage && $value->getSize() > $maxImageSize * 1024) {
                        $fail("Ukuran file gambar tidak boleh lebih dari 10MB.");
                    }
                    if ($isVideo && $value->getSize() > $maxVideoSize * 1024) {
                        $fail("Ukuran file video tidak boleh lebih dari 300MB.");
                    }
                },
            ],
        ]);

        $is_anonymous = $request->boolean('anonim');

        $reporter_name = null;
        $reporter_email = null;
        $reporter_phone = null;

        if ($is_anonymous) {
            $reporter_name = 'Anonim';
        } else {
            if (Auth::check()) {
                $reporter_name = Auth::user()->name;
                $reporter_email = Auth::user()->email;
                $reporter_phone = $request->telepon_pelapor; // Ambil dari form karena mungkin user belum punya data telepon
            } else {
                $reporter_name = $request->nama_pelapor;
                $reporter_email = $request->email_pelapor;
                $reporter_phone = $request->telepon_pelapor;
            }
        }

        $pengaduan = Pengaduan::create([
            'user_id' => Auth::id(),
            'nama_pelapor' => $reporter_name,
            'email_pelapor' => $reporter_email,
            'telepon_pelapor' => $reporter_phone,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'kategori_lainnya' => $request->kategori_id == $lainnyaKategoriId ? $request->kategori_lainnya : null,
            'isi_laporan' => $request->isi_laporan,
            'status' => 'menunggu',
        ]);

        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('public/bukti-pelapor');
                $type = Str::startsWith($file->getMimeType(), 'image/') ? 'image' : 'video';

                $pengaduan->bukti()->create([
                    'pengaduan_id' => $pengaduan->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $type,
                ]);
            }
        }

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
        // Otorisasi: pastikan hanya pemilik yang bisa mengedit
        if (Gate::denies('update', $pengaduan)) {
            abort(403, 'Anda tidak diizinkan untuk mengedit laporan ini.');
        }

        $lainnyaKategoriId = Kategori::where('nama_kategori', 'Lainnya')->first()?->id;

        $request->validate([
            // Validasi sama seperti form kirim pengaduan
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'kategori_lainnya' => [
                Rule::requiredIf($request->input('kategori_id') == $lainnyaKategoriId),
                'nullable', 'string', 'max:100'
            ],
            'isi_laporan' => 'required|string',
            'foto_kejadian' => 'nullable|file|mimes:jpg,jpeg,png,mp4,avi,mov|max:20480',
            'persetujuan' => 'required',
        ]);

        // Ambil semua data kecuali token dan method
        $data = $request->except(['_token', '_method']);

        // Logika untuk menangani file bukti baru
        if ($request->hasFile('bukti_pelapor')) {
            // Hapus file lama jika ada
            if ($pengaduan->bukti()->exists()) {
                Storage::delete($pengaduan->bukti()->exists());
            }
            // Simpan file baru
            $data['bukti_pelapor'] = $request->file('bukti_pelapor')->store('public/bukti-pelapor');
        }

        // Pastikan kategori lainnya null jika bukan kategori "Lainnya"
        $data['kategori_lainnya'] = $request->kategori_id == $lainnyaKategoriId ? $request->kategori_lainnya : null;

        // Update data pengaduan
        $pengaduan->update($data);

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

    public function exportPDF(Pengaduan $pengaduan)
    {
        $pengaduan->load('kategori', 'user', 'penanganan.admin');
        return view('print.detail_laporan', compact('pengaduan'));
    }
}
