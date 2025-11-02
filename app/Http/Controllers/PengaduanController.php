<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pendampingan;
use App\Models\Tindaklanjut;
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
    // === SUPERADMIN ===
    public function laporanMasukSuperAdmin(Request $request)
    {
        $query = Pengaduan::with('kategori', 'pendampingan', 'tindaklanjut')
            ->whereIn('status', ['menunggu', 'penanganan']);

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('bulan')) $query->whereMonth('created_at', $request->bulan);
        if ($request->filled('tahun')) $query->whereYear('created_at', $request->tahun);
        if ($request->filled('sort')) {
            $sort = explode('_', $request->sort);
            if(count($sort) == 2) $query->orderBy($sort[0], $sort[1]);
        } else {
            $query->latest();
        }

        $pengaduans = $query->latest()->paginate(10);
        $kategoris = Kategori::all();
        $pendampingans = Pendampingan::all();
        $tindaklanjuts = Tindaklanjut::all();

        return view('superadmin.laporan_masuk', compact('pengaduans', 'kategoris', 'pendampingans', 'tindaklanjuts'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load('kategori', 'user', 'penanganan.admin', 'pendampingan', 'tindaklanjut');
        $petugas_list = User::where('role', 'admin')->get();

        return view('superadmin.detail', compact('pengaduan', 'petugas_list'));
    }

    public function setujuiPenanganan(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'petugas_id' => 'required|exists:users,id',
        ]);

        $pengaduan->update([
            'status' => 'penanganan',
            'petugas_id' => $request->petugas_id
        ]);

        return redirect()->route('superadmin.surat.penugasan', $pengaduan)
                        ->with('success', 'Laporan disetujui dan surat tugas telah dibuat.');
    }

    public function tolakPengaduan(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10',
        ]);

        $pengaduan->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()->route('superadmin.dashboard')->with('success', 'Pengaduan telah ditolak.');
    }

    public function selesaikanPengaduan(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'layanan_pemulihan' => 'nullable|array',
            'layanan_pemulihan.*' => 'in:psikologis,akademis,administratif',
        ]);

        $pengaduan->update([
            'status' => 'selesai',
            'layanan_pemulihan' => $request->layanan_pemulihan,
        ]);

        return redirect()->route('superadmin.dashboard')->with('success', 'Pengaduan telah ditandai sebagai Selesai.');
    }

    public function laporanSelesai(Request $request)
    {
        $pengaduans = Pengaduan::with('kategori')->where('status', 'selesai')->latest()->paginate(10);
        $pengaduans = Pengaduan::with('pendampingan')->where('status', 'selesai')->latest()->paginate(10);
        $pengaduans = Pengaduan::with('tindaklanjut')->where('status', 'selesai')->latest()->paginate(10);
        return view('superadmin.laporan_selesai', compact('pengaduans'));
    }

    public function laporanDitolak(Request $request)
    {
        $pengaduans = Pengaduan::with('kategori')->where('status', 'ditolak')->latest()->paginate(10);
        $pengaduans = Pengaduan::with('pendampingan')->where('status', 'ditolak')->latest()->paginate(10);
        return view('superadmin.laporan_ditolak', compact('pengaduans'));
    }


    // === ADMIN ===
    public function laporanMasukAdmin(Request $request)
    {
        $query = Pengaduan::with('kategori', 'pendampingan', 'tindaklanjut')
            ->where('status', 'penanganan')
            ->where('petugas_id', Auth::id());

        $pengaduans = $query->latest('updated_at')->paginate(10);
        return view('admin.laporan_masuk', compact('pengaduans'));
    }

    public function showAdmin(Pengaduan $pengaduan)
    {
        if($pengaduan->status !== 'penanganan'){
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }
        $pengaduan->load('kategori', 'user', 'pendampingan', 'penanganan.admin');
        $tindaklanjuts = Tindaklanjut::all();
        return view('admin.detail_penanganan', compact('pengaduan', 'tindaklanjuts'));
    }

    // === PUBLIC / USER ===
    public function createPublic()
    {
        $kategoris = Kategori::all();
        $pendampingans = Pendampingan::all();
        $tindaklanjuts = Tindaklanjut::all();
        return view('public.kirim_pengaduan', compact('kategoris', 'pendampingans', 'tindaklanjuts'));
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
            'pendampingan_id' => 'required|exists:pendampingans,id',
            'isi_laporan' => 'required|string',
            'persetujuan' => 'required',
            'bukti' => 'required|array|max:6',
            'bukti.*' => [
                'file',
                'mimes:' . $imageFormats . ',' . $videoFormats,
                function ($attribute, $value, $fail) {
                    $maxImageSize = 10 * 1024;
                    $maxVideoSize = 300 * 1024;

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
                $reporter_phone = $request->telepon_pelapor;
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
            'pendampingan_id' => $request->pendampingan_id,
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

    public function showUser(Pengaduan $pengaduan)
    {
        if (Gate::denies('view', $pengaduan)) {
            abort(403);
        }
        return view('user.detail_pengaduan', compact('pengaduan'));
    }

    public function editUser(Pengaduan $pengaduan)
    {
        if (Gate::denies('update', $pengaduan)) {
            abort(403, 'Anda tidak dapat mengedit laporan ini.');
        }
        $kategoris = Kategori::all();
        $pendampingans = Pendampingan::all();
        $lainnyaKategoriId = Kategori::where('nama_kategori', 'Lainnya')->first()?->id;
        if ($pengaduan->kategori_id == $lainnyaKategoriId) {
            $pengaduan->kategori_lainnya = $pengaduan->kategori_lainnya;
        } else {
            $pengaduan->kategori_lainnya = null;
        }
        return view('user.edit_pengaduan', compact('pengaduan', 'kategoris', 'pendampingans', 'lainnyaKategoriId'));
    }

    public function updateUser(Request $request, Pengaduan $pengaduan)
    {
        if (Gate::denies('update', $pengaduan)) {
            abort(403, 'Anda tidak diizinkan untuk mengedit laporan ini.');
        }

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
            'pendampingan_id' => 'required|exists:pendampingans,id',
            'isi_laporan' => 'required|string',
            'persetujuan' => 'required',
            'bukti' => 'nullable|array|max:6',
            'bukti.*' => [
                'file',
                'mimes:' . $imageFormats . ',' . $videoFormats,
                function ($attribute, $value, $fail) {
                    $maxImageSize = 10 * 1024;
                    $maxVideoSize = 300 * 1024;

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
                $reporter_phone = $request->telepon_pelapor;
            } else {
                $reporter_name = $request->nama_pelapor;
                $reporter_email = $request->email_pelapor;
                $reporter_phone = $request->telepon_pelapor;
            }
        }


        $pengaduan->update([
            'user_id' => Auth::id(),
            'nama_pelapor' => $reporter_name,
            'email_pelapor' => $reporter_email,
            'telepon_pelapor' => $reporter_phone,
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'pendampingan_id' => $request->pendampingan_id,
            'isi_laporan' => $request->isi_laporan,
            'kategori_lainnya' => $request->kategori_id == $lainnyaKategoriId ? $request->kategori_lainnya : null,
        ]);

        if ($request->hasFile('bukti')) {
            foreach ($pengaduan->bukti as $buktiLama) {
                Storage::delete($buktiLama->file_path);
            }
            $pengaduan->bukti()->delete();

            foreach ($request->file('bukti') as $file) {
                $path = $file->store('public/bukti-pelapor');
                $type = Str::startsWith($file->getMimeType(), 'image/') ? 'image' : 'video';

                $pengaduan->bukti()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $type,
                ]);
            }
        }

        return redirect()->route('account.pengaduan.show', $pengaduan)->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroyUser(Pengaduan $pengaduan)
    {
        if (Gate::denies('delete', $pengaduan)) {
            abort(403);
        }

        if ($pengaduan->foto_kejadian) {
            Storage::delete($pengaduan->foto_kejadian);
        }
        $pengaduan->delete();

        return redirect()->route('account.index')->with('success', 'Laporan berhasil dihapus.');
    }

    public function exportPDF(Pengaduan $pengaduan)
    {
        $pengaduan->load('kategori', 'user', 'penanganan.admin', 'pendampingan', 'tindaklanjut');
        return view('print.detail_laporan', compact('pengaduan'));
    }
}
