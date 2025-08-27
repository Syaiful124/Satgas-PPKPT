@extends('layouts.app')

@section('title', 'Detail Laporan Pengaduan')

@section('content')
<div class="flex justify-between items-center mb-4 title-h">
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
            <div class="mb-4">
                <p class="text-sm text-gray-500">Kategori</p>
                <p class="font-semibold">{{ $pengaduan->kategori->nama_kategori }}</p>
            </div>
            @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
            <div class="mb-4">
                <p class="text-sm text-gray-500">Kategori Lainnya yang Disebutkan</p>
                <p class="font-semibold text-orange-600">{{ $pengaduan->kategori_lainnya }}</p>
            </div>
            @endif
            <div class="grid grid-cols-2 grid-rows-3 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Dilaporkan</p>
                    <p class="font-semibold">{{ $pengaduan->created_at?->translatedFormat('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->email_pelapor ?? '-' }}</p>
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
                <div>
                    <p class="text-sm text-gray-500">Telepon Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->telepon_pelapor ?? '-' }}</p>
                </div>
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
                        <button type="submit" class=" w-full btn-primary px-6 py-2 rounded-lg">Buat Surat Tugas</button>
                    </form>
                    <div class="my-4 flex items-center">
                        <hr class="flex-grow border-t">
                        <span class="px-2 text-xs text-gray-500">ATAU</span>
                        <hr class="flex-grow border-t">
                    </div>
                    <form action="{{ route('superadmin.laporan.tolak', $pengaduan) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menolak laporan ini?');">
                        @csrf
                        <button type="submit" class="w-full btn-danger px-4 py-2 rounded-lg">Tolak Laporan</button>
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
                    <div class="text-center flex justify-center">
                        <a href="{{ route('superadmin.laporan.pdf', $pengaduan) }}" target="_blank" class="w-max flex items-center gap-1 bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                            </svg>
                            Print
                        </a>
                    </div>
                    @break

                @case('ditolak')
                    <p class="text-sm text-center text-gray-600">Laporan ini telah ditolak.</p>
                    <div class="text-center flex justify-center">
                        <a href="{{ route('superadmin.laporan.pdf', $pengaduan) }}" target="_blank" class="w-max flex items-center gap-1 bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                            <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                            <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1"/>
                            </svg>
                            Print
                        </a>
                    </div>
                    @break
            @endswitch
        </div>
    </div>

    <div class="lg:col-span-2 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold mb-2">Bukti Kejadian (dari Pelapor)</h3>
            @if ($pengaduan->bukti->isNotEmpty())
                <div class="grid grid-cols-2 gap-2 mb-4 min-h-[100px] max-h-[400px] overflow-y-auto">
                    @foreach($pengaduan->bukti as $bukti)
                        <div>
                            @if($bukti->file_type == 'image')
                                <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full rounded-lg shadow">
                            @else
                                <video src="{{ Storage::url($bukti->file_path) }}" controls class="w-full rounded-lg shadow"></video>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">
                    Tidak ada bukti yang dilampirkan.
                </div>
            @endif
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold mb-2">Bukti Penanganan (dari Petugas)</h3>
            @if ($pengaduan->penanganan && $pengaduan->penanganan->bukti->isNotEmpty())
            <div class="grid grid-cols-2 gap-2 mb-4 min-h-[100px] max-h-[400px] overflow-y-auto">
                @foreach($pengaduan->penanganan->bukti as $bukti)
                    <div>
                        @if($bukti->file_type == 'image')
                            <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full rounded-lg shadow">
                        @else
                            <video src="{{ Storage::url($bukti->file_path) }}" controls class="w-full rounded-lg shadow"></video>
                        @endif
                    </div>
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
@endsection
