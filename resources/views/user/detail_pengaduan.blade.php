@extends('layouts.public')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <a href="{{ route('account.index') }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">&larr; Kembali ke Akun</a>
    <div class="flex justify-between items-center mb-2">
        <h1 class="text-3xl font-bold">Laporan Pengaduan</h1>
        @can('update', $pengaduan)
        <div class="flex space-x-2">
            <a href="{{ route('account.pengaduan.edit', $pengaduan) }}" class="bg-yellow-400 text-white px-4 py-2 rounded-lg hover:bg-yellow-500">Edit</a>
            <form action="{{ route('account.pengaduan.destroy', $pengaduan) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus laporan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Hapus</button>
            </form>
        </div>
        @endcan
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <h2 class="text-2xl font-semibold">{{ $pengaduan->judul }}</h2>
            <p class="text-gray-500 mb-4">
                Kategori:
                <span class="font-semibold">{{ $pengaduan->kategori->nama_kategori }}
                    @if($pengaduan->kategori_lainnya)
                        ({{ $pengaduan->kategori_lainnya }})
                    @endif
                </span>
            </p>
            <div class="flex justify-between text-sm text-gray-600 mb-4">
                <p>Status: <span class="font-bold">{{ ucfirst($pengaduan->status) }}</span></p>
                <p>{{ $pengaduan->created_at?->format('d-m-Y H:i') }}</p>
            </div>
            <div class="mb-4">
                <h3 class="font-bold mb-2">Kronologi Kejadian:</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->isi_laporan }}</p>
            </div>
        </div>
        <div>
            <h3 class="font-bold mb-2">Bukti Kejadian</h3>
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
    </div>

    @if($pengaduan->penanganan)
    <hr class="my-8">
    <h2 class="text-2xl font-bold mb-4">Informasi Penanganan</h2>
    <div class="bg-gray-50 p-6 rounded-lg border">
        <p class="mb-2"><strong>Ditangani oleh:</strong> Satgas PPKPT</p>
        <p class="mb-2"><strong>Tanggal:</strong> {{ $pengaduan->penanganan->created_at->format('d M Y') }}</p>
        <p class="font-bold mb-2">Laporan Hasil Penanganan:</p>
        <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->isi_penanganan }}</p>
    </div>
    @endif
</div>
@endsection
