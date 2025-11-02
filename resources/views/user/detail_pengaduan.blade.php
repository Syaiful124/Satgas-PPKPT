@extends('layouts.public')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="flex justify-between items-center my-4 mx-8 border-b-4 border-orange-200">
    <div class="flex items-center justify-start text-center gap-4 bg-white py-2 px-4 rounded-lg shadow-md w-full">
        <a href="{{ route('account.index') }}" class="font-bold text-[30px] inline-block ">&larr; </a>
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
            <div class="flex flex-row gap-4 w-full">
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Pelapor</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Tanggal Dilaporkan</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->created_at?->translatedFormat('d F Y, H:i') }}</p>
                </div>
            </div>
            @if (!empty($pengaduan->email_pelapor) || !empty($pengaduan->telepon_pelapor))
                <div class="flex flex-row gap-4 w-full">
                    @if (!empty($pengaduan->email_pelapor))
                        <div class="w-full">
                            <p class="text-[16px] font-semibold">Email Pelapor</p>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->email_pelapor }}</p>
                        </div>
                    @endif
                    @if (!empty($pengaduan->telepon_pelapor))
                        <div class="w-full">
                            <p class="text-[16px] font-semibold">Telepon Pelapor</p>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->telepon_pelapor }}</p>
                        </div>
                    @endif
                </div>
            @endif
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
                    <div class=" relative grid md:grid-cols-3 gap-2 min-h-[100px] max-h-[315px] overflow-y-auto border-lg rounded-lg bg-gray-100 p-2 items-center justify-center shadow-lg">
                        @foreach($pengaduan->bukti as $bukti)
                            <a href="{{ Storage::url($bukti->file_path) }}" data-fancybox="gallery" data-caption="{{ $bukti->file_name }}" class="group relative block bg-gray-900 rounded-lg overflow-hidden hover:scale-auto rounded-lg shadow-lg">
                                @if($bukti->file_type == 'image')
                                    <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full max-h-[300px] object-cover transform group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <video src="{{ Storage::url($bukti->file_path) }}" class="w-full max-h-[300px] object-cover transform group-hover:scale-110 transition-transform duration-300"></video>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    @if ($bukti->file_type == 'video')
                                        <svg class="w-16 h-16 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                    @else
                                        <svg class="w-16 h-16 text-white opacity-0 group-hover:opacity-80 transition-opacity duration-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8zm8-3a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    @endif
                                </div>
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
                    <div class=" relative grid md:grid-cols-3 gap-2 min-h-[100px] max-h-[315px] overflow-y-auto border-lg rounded-lg bg-gray-100 p-2 items-center justify-center shadow-lg">
                        @foreach($pengaduan->penanganan->bukti as $bukti)
                            <a href="{{ Storage::url($bukti->file_path) }}" data-fancybox="gallery" data-caption="{{ $bukti->file_name }}" class="group relative block bg-gray-900 rounded-lg overflow-hidden hover:scale-auto rounded-lg shadow-lg items-center justify-center">
                                @if($bukti->file_type == 'image')
                                    <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full max-h-[300px] object-cover transform group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <video src="{{ Storage::url($bukti->file_path) }}" class="w-full max-h-[300px] object-cover transform group-hover:scale-110 transition-transform duration-300"></video>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                                    @if ($bukti->file_type == 'video')
                                        <svg class="w-16 h-16 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                    @else
                                        <svg class="w-16 h-16 text-white opacity-0 group-hover:opacity-80 transition-opacity duration-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8zm8-3a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    @endif
                                </div>
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

    <div class="bg-white p-6 rounded-lg shadow-md gap-4 flex flex-col">
        <h2 class="text-2xl font-semibold border-b pb-2">Hasil Akhir</h2>
        <div class="flex flex-row gap-4">
            <div class="w-full">
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

            @if ($pengaduan->status == 'ditolak' && $pengaduan->alasan_penolakan)
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Alasan Penolakan:</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->alasan_penolakan }}</p>
                </div>
            @endif

            @if($pengaduan->status == 'selesai' && !empty($pengaduan->layanan_pemulihan))
            <div class="w-full">
                <p class="text-[16px] font-semibold">Layanan Pemulihan Diberikan</p>
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($pengaduan->layanan_pemulihan as $layanan)
                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full">{{ ucfirst($layanan) }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
