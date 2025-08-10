@extends('layouts.app')
@section('title', 'Detail Laporan')

@section('content')
<a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">&larr; BACK</a>
<h1 class="text-3xl font-bold mb-6">Laporan Pengaduan</h1>

<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    </div>

@if($pengaduan->penanganan)
<div class="bg-white p-6 rounded-lg shadow-md">
     <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <h3 class="text-xl font-bold">Laporan Penanganan oleh: {{ $pengaduan->penanganan->admin->name }}</h3>
             <p class="text-sm text-gray-600 mb-4">{{ $pengaduan->penanganan->created_at->format('d-m-Y H:i') }}</p>
            <div class="mb-4">
                <h3 class="font-bold mb-2">Penjelasan Penanganan:</h3>
                <p class="text-gray-700">{{ $pengaduan->penanganan->isi_penanganan }}</p>
            </div>
        </div>
        <div>
            <h3 class="font-bold mb-2">Bukti Penanganan</h3>
             @if($pengaduan->penanganan->foto_penanganan)
            <img src="{{ Storage::url($pengaduan->penanganan->foto_penanganan) }}" alt="Bukti Penanganan" class="w-full rounded-lg shadow-md">
            @else
            <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">Tidak ada bukti gambar.</div>
            @endif
        </div>
    </div>

    @if($pengaduan->status == 'penanganan')
    <div class="mt-8 flex justify-end space-x-4">
        <form action="{{ route('superadmin.laporan.selesaikan', $pengaduan) }}" method="POST">
            @csrf
            <button type="submit" class="btn-success px-6 py-2 rounded-lg">Selesai</button>
        </form>
        <form action="{{ route('superadmin.laporan.tolak', $pengaduan) }}" method="POST">
            @csrf
            <button type="submit" class="btn-danger px-6 py-2 rounded-lg">Tolak</button>
        </form>
    </div>
    @elseif($pengaduan->status == 'selesai')
    <div class="mt-8 flex justify-end">
        {{-- Tombol Print jika di detail laporan selesai --}}
        <a href="#" class="bg-gray-700 text-white px-6 py-2 rounded-lg">Print</a>
    </div>
    @endif
</div>
@else
<div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md">
    Laporan ini sedang menunggu penanganan oleh Admin.
</div>
@endif

@endsection
