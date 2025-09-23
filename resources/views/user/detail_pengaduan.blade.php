@extends('layouts.public')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="flex justify-between items-center my-4 mx-8 border-b-4 p-2">
    <div class="flex items-center gap-3 ">
        <a href="{{ route('account.index') }}" class="text-[20px] text-gray-600 hover:text-gray-900 inline-block ">&larr; </a>
        <h1 class="text-3xl font-bold">Detail Laporan</h1>
    </div>
    @can('update', $pengaduan)
    <div class="flex space-x-2">
        <a href="{{ route('account.pengaduan.edit', $pengaduan) }}" class="bg-yellow-300 px-4 py-2 rounded-lg hover:bg-yellow-500 hover:text-white font-semibold">Edit</a>
        <form action="{{ route('account.pengaduan.destroy', $pengaduan) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus laporan ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-300 px-4 py-2 rounded-lg hover:bg-red-500 hover:text-white font-semibold">Hapus</button>
        </form>
    </div>
    @endcan
</div>

<div class="flex flex-col gap-6 mx-8">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Laporan Pengaduan</h2>
        <div class="flex flex-col gap-4">
            <div class="grid grid-cols-2 grid-rows-1 gap-4">
                <div>
                    <p class="text-[16px] font-semibold">Pelapor</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
                <div>
                    <p class="text-[16px] font-semibold">Tanggal Dilaporkan</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->created_at?->translatedFormat('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-[16px] font-semibold">Email Pelapor</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->email_pelapor ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[16px] font-semibold">Telepon Pelapor</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->telepon_pelapor ?? '-' }}</p>
                </div>
            </div>
            <div>
                <p class="text-[16px] font-semibold">Judul Laporan</p>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->judul }}</p>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Kategori</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->kategori->nama_kategori }}</p>
                    @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->kategori_lainnya }}</p>
                    @endif
                </div>
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Pendampingan</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->pendampingan->opsi_pendampingan }}</p>
                </div>
            </div>
            <div>
                <p class="text-[16px] font-semibold">Kronologi Kejadian</p>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->isi_laporan }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="text-[16px] font-semibold">Bukti Kejadian Anda</h3>
                @if ($pengaduan->bukti->isNotEmpty())
                    <div class="grid grid-cols-3 gap-2 min-h-[100px] max-h-[215px] overflow-y-auto border-lg rounded-lg bg-gray-100 p-2">
                        @foreach($pengaduan->bukti as $bukti)
                            <a href="{{ Storage::url($bukti->file_path) }}" target="_blank" class="block transform hover:scale-auto transition-transform duration-300">
                                @if($bukti->file_type == 'image')
                                    <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full max-h-[200px] rounded-lg shadow">
                                @else
                                    <video src="{{ Storage::url($bukti->file_path) }}" controls class="w-full max-h-[200px] rounded-lg shadow"></video>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">
                        Tidak ada bukti yang dilampirkan.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md gap-4 flex flex-col">
        <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Tanggapan dari Satgas</h2>
        <div class="space-y-4">
            <div class="flex">
                <div>
                    <p class="text-[16px] font-semibold">Status Saat Ini</p>
                    @if($pengaduan->status == 'menunggu')
                        <p class="text-orange-500">Menunggu</p>
                        <p class="text-xs text-gray-500">Menunggu Verifikasi</p>
                    @elseif($pengaduan->status == 'penanganan')
                        <p class="text-blue-500">Penanganan</p>
                        <p class="text-xs text-gray-500">
                            @if($pengaduan->penanganan)
                                Menunggu Ditindaklanjuti
                            @else
                                Menunggu Klarifikasi & Pemeriksaan Petugas
                            @endif
                        </p>
                    @elseif($pengaduan->status == 'selesai')
                        <p class="text-green-500">Selesai</p>
                    @elseif($pengaduan->status == 'ditolak')
                        <p class="text-red-500">Ditolak</p>
                    @endif
                </div>
                <div>
                    @if ($pengaduan->status == 'ditolak' && $pengaduan->alasan_penolakan)
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-md">
                            <p class="text-sm text-red-700 font-semibold">Alasan dari Satgas:</p>
                            <p class="text-red-700 mt-1 whitespace-pre-wrap">{{ $pengaduan->alasan_penolakan }}</p>
                        </div>
                    @endif
                </div>
            </div>

            @if ($pengaduan->penanganan)
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-[16px] font-semibold">Ditangani oleh Petugas</p>
                        <p class="ftext-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->admin->name }}</p>
                    </div>
                    <div>
                        <p class="text-[16px] font-semibold">Tanggal Ditangani</p>
                        <p class="ftext-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->created_at?->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div >
                    <p class="text-[16px] font-semibold">Tindak Lanjut</p>
                    <p class="ftext-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->tindaklanjut->opsi_tindaklanjut }}</p>
                </div>
                <div>
                    <p class="text-[16px] font-semibold">Isi Laporan Penanganan</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->isi_penanganan }}</p>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-[16px] font-semibold">Bukti Penanganan</h3>
                    @if ($pengaduan->penanganan && $pengaduan->penanganan->bukti->isNotEmpty())
                    <div class="grid grid-cols-3 gap-2 min-h-[100px] max-h-[215px] overflow-y-auto border-lg rounded-lg bg-gray-100 p-2">
                        @foreach($pengaduan->penanganan->bukti as $bukti)
                            <a href="{{ Storage::url($bukti->file_path) }}" target="_blank" class="block transform hover:scale-auto transition-transform duration-300">
                                @if($bukti->file_type == 'image')
                                    <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full max-h-[200px] rounded-lg shadow">
                                @else
                                    <video src="{{ Storage::url($bukti->file_path) }}" controls class="w-full max-h-[200px] rounded-lg shadow"></video>
                                @endif
                            </a>
                        @endforeach
                    </div>
                    @else
                        <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">
                            Tidak ada bukti yang dilampirkan.
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center text-gray-500 py-8">
                    <p>Belum ada laporan penanganan dari petugas.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
