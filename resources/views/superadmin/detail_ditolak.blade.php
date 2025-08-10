@extends('layouts.app')
@section('title', 'Detail Laporan Ditolak')

@section('content')
<a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">&larr; BACK</a>
<h1 class="text-3xl font-bold mb-2">Detail Laporan Ditolak</h1>
<p class="text-gray-500 mb-6">Laporan ini ditolak pada {{ $pengaduan->updated_at->format('d M Y H:i') }}</p>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <h2 class="text-2xl font-bold">{{ $pengaduan->judul }}</h2>
            <p class="text-gray-500 mb-4">{{ $pengaduan->kategori->nama_kategori }}</p>
            <div class="flex justify-between text-sm text-gray-600 mb-4">
                <p>Pelapor: {{ $pengaduan->nama_pelapor }}</p>
                <p>{{ $pengaduan->created_at->format('d-m-Y H:i') }}</p>
            </div>
            <div class="mb-4">
                <h3 class="font-bold mb-2">Kronologi Kejadian:</h3>
                <p class="text-gray-700">{{ $pengaduan->isi_laporan }}</p>
            </div>
        </div>
        <div>
            <h3 class="font-bold mb-2">Bukti Kejadian</h3>
            @if($pengaduan->foto_kejadian)
            <img src="{{ Storage::url($pengaduan->foto_kejadian) }}" alt="Bukti Kejadian" class="w-full rounded-lg shadow-md">
            @else
            <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">Tidak ada bukti gambar.</div>
            @endif
        </div>
    </div>
</div>
@endsection
