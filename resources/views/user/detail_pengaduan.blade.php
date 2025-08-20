@extends('layouts.public')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="flex justify-between items-center mb-4">
    <div>
        <a href="{{ route('account.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mb-2 inline-block">&larr; Kembali ke Riwayat</a>
        <h1 class="text-3xl font-bold">Detail Laporan</h1>
    </div>
    @can('update', $pengaduan)
    <div class="flex space-x-2">
        <a href="{{ route('account.pengaduan.edit', $pengaduan) }}" class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500 font-semibold">Edit</a>
        <form action="{{ route('account.pengaduan.destroy', $pengaduan) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus laporan ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 font-semibold">Hapus</button>
        </form>
    </div>
    @endcan
</div>

<div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
    <div class="lg:col-span-3 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Laporan Pengaduan Anda</h2>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Judul Laporan</p>
                <p class="text-lg font-bold">{{ $pengaduan->judul }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-500">Kategori</p>
                    <p class="font-semibold">{{ $pengaduan->kategori->nama_kategori }}</p>
                </div>
                @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                <div>
                    <p class="text-sm text-gray-500">Kategori Lainnya</p>
                    <p class="font-semibold text-orange-600">{{ $pengaduan->kategori_lainnya }}</p>
                </div>
                @endif
                <div>
                    <p class="text-sm text-gray-500">Tanggal Dilaporkan</p>
                    <p class="font-semibold">{{ $pengaduan->created_at?->format('d M Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Pelapor</p>
                    <p class="font-semibold">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
            </div>

            <div>
                <p class="text-sm text-gray-500">Kronologi Kejadian</p>
                <p class="text-gray-700 whitespace-pre-wrap mt-1">{{ $pengaduan->isi_laporan }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Tanggapan dari Satgas</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Status Laporan</p>
                    <p class="font-bold text-lg
                        @if($pengaduan->status == 'menunggu') text-orange-500 @endif
                        @if($pengaduan->status == 'penanganan') text-blue-500 @endif
                        @if($pengaduan->status == 'selesai') text-green-600 @endif
                        @if($pengaduan->status == 'ditolak') text-red-600 @endif
                    ">{{ ucfirst($pengaduan->status) }}</p>
                </div>

                @if($pengaduan->penanganan)
                    <div>
                        <p class="text-sm text-gray-500">Tanggal Ditangani</p>
                        <p class="font-semibold">{{ $pengaduan->penanganan->created_at?->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Isi Tanggapan</p>
                        <p class="text-gray-700 whitespace-pre-wrap mt-1">{{ $pengaduan->penanganan->isi_penanganan }}</p>
                    </div>
                @elseif($pengaduan->status == 'menunggu')
                    <p class="text-gray-600">Laporan Anda sedang menunggu untuk direview oleh tim Satgas.</p>
                @else
                    <p class="text-gray-600">Tim Satgas sedang memproses laporan Anda. Informasi tanggapan akan muncul di sini setelah tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="lg:col-span-2 flex flex-col gap-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="font-bold mb-2">Bukti Kejadian Anda</h3>
            @if($pengaduan->foto_kejadian)
                @if(Str::contains($pengaduan->foto_kejadian, ['.jpg', '.jpeg', '.png', '.gif']))
                <img src="{{ Storage::url($pengaduan->foto_kejadian) }}" alt="Bukti" class="w-full rounded-lg shadow">
                @else
                <video src="{{ Storage::url($pengaduan->foto_kejadian) }}" controls class="w-full rounded-lg shadow"></video>
                @endif
            @else
            <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">Tidak ada bukti.</div>
            @endif
        </div>

        @if ($pengaduan->penanganan?->foto_penanganan)
        <div class="bg-white p-6 rounded-lg shadow-md">
             <h3 class="font-bold mb-2">Bukti Penanganan dari Satgas</h3>
             <img src="{{ Storage::url($pengaduan->penanganan->foto_penanganan) }}" alt="Bukti Penanganan" class="w-full rounded-lg shadow">
        </div>
        @endif
    </div>
</div>
@endsection
