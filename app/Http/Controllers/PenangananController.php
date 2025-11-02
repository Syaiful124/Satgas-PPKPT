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
            'bukti' => 'nullable|array|max:6',
            'bukti.*' => [
                'file',
                'mimes:' . $imageFormats . ',' . $videoFormats,
                function ($attribute, $value, $fail) {
                    $maxImageSize = 10 * 1024;
                    $maxVideoSize = 300 * 1024;

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

        $penanganan = $pengaduan->penanganan()->updateOrCreate(
            ['pengaduan_id' => $pengaduan->id],
            [
                'admin_id' => Auth::id(),
                'tindaklanjut_id' => $request->tindaklanjut_id,
                'isi_penanganan' => $request->isi_penanganan,
            ]
        );

        if ($request->hasFile('bukti')) {
            foreach ($penanganan->bukti as $buktiLama) {
                Storage::delete($buktiLama->file_path);
                $buktiLama->delete();
            }

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

        $pengaduan->update(['status' => 'penanganan']);

        return redirect()->route('admin.laporan.masuk')->with('success', 'Laporan penanganan berhasil dikirim.');
    }
}
