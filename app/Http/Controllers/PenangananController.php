<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tindaklanjut;
use App\Models\Penanganan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\BuktiPenanganan;
use Illuminate\Support\Str;


class PenangananController extends Controller
{
    public function store(Request $request, Pengaduan $pengaduan)
    {
        $imageFormats = 'jpg,jpeg,png,gif,webp,heic';
        $videoFormats = 'mp4,mov,avi,mkv,webm,flv';

        $request->validate([
            'tindaklanjut_id' => 'required|exists:tindaklanjuts,id',
            'isi_penanganan' => 'required|string',
            'bukti' => 'nullable|array|max:6', // Validasi untuk multi-file
            'bukti.*' => [
                'file',
                'mimes:' . $imageFormats . ',' . $videoFormats,
                function ($attribute, $value, $fail) {
                    $maxImageSize = 10 * 1024; // 10 MB
                    $maxVideoSize = 300 * 1024; // 300 MB

                    $isImage = Str::startsWith($value->getMimeType(), 'image/');
                    if ($isImage && $value->getSize() > $maxImageSize * 1024) {
                        $fail("Ukuran file gambar tidak boleh lebih dari 10MB.");
                    }

                    $isVideo = Str::startsWith($value->getMimeType(), 'video/');
                    if ($isVideo && $value->getSize() > $maxVideoSize * 1024) {
                        $fail("Ukuran file video tidak boleh lebih dari 300MB.");
                    }
                },
            ],
        ]);

        // Buat atau update data penanganan
        $penanganan = $pengaduan->penanganan()->updateOrCreate(
            ['pengaduan_id' => $pengaduan->id],
            [
                'admin_id' => Auth::id(),
                'tindaklanjut_id' => $request->tindaklanjut_id,
                'isi_penanganan' => $request->isi_penanganan,
            ]
        );

        // Proses upload file bukti baru
        if ($request->hasFile('bukti')) {
            // Hapus bukti lama terlebih dahulu jika ada
            foreach ($penanganan->bukti as $buktiLama) {
                Storage::delete($buktiLama->file_path);
                $buktiLama->delete();
            }

            // Simpan bukti baru
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('public/bukti-penanganan');
                $type = Str::startsWith($file->getMimeType(), 'image/') ? 'image' : 'video';

                $penanganan->bukti()->create([
                    'penanganan_id' => $penanganan->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $type,
                ]);
            }
        }

        // Update status pengaduan utama
        $pengaduan->update(['status' => 'penanganan']);

        return redirect()->route('admin.laporan.masuk')->with('success', 'Laporan penanganan berhasil dikirim.');
    }
}
