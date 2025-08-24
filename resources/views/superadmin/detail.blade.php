@extends('layouts.app')

@section('title', 'Detail Laporan Pengaduan')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-3xl font-bold">Detail Laporan</h1>
    <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-900">&larr; KEMBALI</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
    <div class="lg:col-span-3 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Laporan Pengaduan</h2>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Judul Laporan</p>
                <p class="text-lg font-bold">{{ $pengaduan->judul }}</p>
            </div>

            <div class="grid grid-cols-2 grid-rows-3 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="font-semibold">{{ $pengaduan->kategori->nama_kategori }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Dilaporkan</p>
                    <p class="font-semibold">{{ $pengaduan->created_at?->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->email_pelapor }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Telepon Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->telepon_pelapor }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Saat Ini</p>
                    <p class="font-bold
                        @if($pengaduan->status == 'menunggu') text-orange-500 @endif
                        @if($pengaduan->status == 'penanganan') text-blue-500 @endif
                        @if($pengaduan->status == 'selesai') text-green-500 @endif
                        @if($pengaduan->status == 'ditolak') text-red-500 @endif
                    ">{{ ucfirst($pengaduan->status) }}</p>
                </div>
                @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                <div class="col-span-2">
                    <p class="text-sm text-gray-500">Kategori Lainnya yang Disebutkan</p>
                    <p class="font-semibold text-orange-600">{{ $pengaduan->kategori_lainnya }}</p>
                </div>
                @endif
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Kronologi Kejadian</p>
                <p class="text-gray-700 whitespace-pre-wrap mt-1">{{ $pengaduan->isi_laporan }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Laporan Penanganan</h2>

            @if ($pengaduan->penanganan)
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-sm text-gray-500">Ditangani oleh Petugas</p>
                        <p class="font-semibold">{{ $pengaduan->penanganan->admin->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Ditangani</p>
                        <p class="font-semibold">{{ $pengaduan->penanganan->created_at?->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Isi Laporan Penanganan</p>
                    <p class="text-gray-700 whitespace-pre-wrap mt-1">{{ $pengaduan->penanganan->isi_penanganan }}</p>
                </div>
            @else
                <div class="text-center text-gray-500 py-8">
                    <p>Belum ada laporan penanganan dari petugas.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="lg:col-span-2 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold mb-2">Bukti Kejadian (dari Pelapor)</h3>
            @if($pengaduan->foto_kejadian)
                @if(Str::contains($pengaduan->foto_kejadian, ['.jpg', '.jpeg', '.png', '.gif']))
                <img src="{{ Storage::url($pengaduan->foto_kejadian) }}" alt="Bukti" class="w-full rounded-lg shadow">
                @else
                <video src="{{ Storage::url($pengaduan->foto_kejadian) }}" controls class="w-full rounded-lg shadow"></video>
                @endif
            @else
            <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">Tidak ada bukti gambar/video.</div>
            @endif
        </div>

        @if ($pengaduan->penanganan)
        <div class="bg-white p-6 rounded-lg shadow-md">
             <h3 class="font-bold mb-2">Bukti Penanganan (dari Petugas)</h3>
             @if($pengaduan->penanganan->foto_penanganan)
                <img src="{{ Storage::url($pengaduan->penanganan->foto_penanganan) }}" alt="Bukti Penanganan" class="w-full rounded-lg shadow">
             @else
             <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">Tidak ada bukti gambar.</div>
             @endif
        </div>
        @endif

        <div class="bg-gray-50 p-6 rounded-lg border">
            <h3 class="font-bold text-center mb-4">Panel Aksi</h3>
            @if ($pengaduan->petugas_id)
                <div class="text-center mb-4">
                    <a href="{{ route('superadmin.surat.penugasan', $pengaduan) }}" target="_blank" class="w-full block bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-gray-700">
                        Lihat/Cetak Ulang Surat Tugas
                    </a>
                </div>
                @if($pengaduan->status != 'menunggu')
                    <hr class="my-4">
                @endif
            @endif
            @switch($pengaduan->status)
                @case('menunggu')
                    <p class="text-sm text-center text-gray-600 mb-4">Pilih petugas untuk menangani laporan ini, kemudian setujui.</p>
                    <form action="{{ route('superadmin.laporan.setujui', $pengaduan) }}" target="_blank" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="petugas_id" class="block font-semibold mb-2">Tugaskan kepada Petugas:</label>
                            <select name="petugas_id" id="petugas_id" class="w-full p-2 border rounded-lg" required>
                                <option value="">-- Pilih Petugas --</option>
                                @foreach ($petugas_list as $petugas)
                                    <option value="{{ $petugas->id }}">{{ $petugas->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex justify-center space-x-4 mt-4">
                            <button type="submit" class="btn-primary px-6 py-2 rounded-lg">Setujui & Buat Surat Tugas</button>
                            <form action="{{ route('superadmin.laporan.tolak', $pengaduan) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="btn-danger px-4 py-2 rounded-lg">Tolak Laporan</button>
                            </form>
                        </div>
                    </form>
                    @break

                @case('penanganan')
                    @if ($pengaduan->penanganan)
                        <p class="text-sm text-center text-gray-600 mb-4">Petugas telah mengirim laporan penanganan. Konfirmasi jika laporan sudah selesai.</p>
                        <div class="text-center">
                            <form action="{{ route('superadmin.laporan.selesaikan', $pengaduan) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-success px-6 py-2 rounded-lg">Konfirmasi Selesai</button>
                            </form>
                        </div>
                    @else
                        <p class="text-sm text-center text-gray-600">Laporan sedang menunggu penanganan dan laporan dari petugas.</p>
                    @endif
                    @break

                @case('selesai')
                    <p class="text-sm text-center text-gray-600">Laporan ini telah selesai ditangani.</p>
                    <div class="text-center">
                        <a href="{{ route('superadmin.laporan.pdf', $pengaduan) }}" target="_blank" class="inline-block bg-red-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-700">
                            Export ke PDF
                        </a>
                    </div>
                    @break

                @case('ditolak')
                    <p class="text-sm text-center text-gray-600">Laporan ini telah ditolak.</p>
                    <div class="text-center">
                        <a href="{{ route('superadmin.laporan.pdf', $pengaduan) }}" target="_blank" class="inline-block bg-red-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-700">
                            Export ke PDF
                        </a>
                    </div>
                    @break
            @endswitch
        </div>
    </div>
</div>
@endsection
