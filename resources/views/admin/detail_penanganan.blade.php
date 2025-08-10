@extends('layouts.app')
@section('title', 'Form Penanganan')

@section('content')
<a href="{{ route('admin.laporan.masuk') }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">&larr; BACK</a>
<h1 class="text-3xl font-bold mb-6">Laporan Pengaduan</h1>

<div class="bg-white p-6 rounded-lg shadow-md mb-6">
    </div>

<form action="{{ route('admin.laporan.tangani', $pengaduan) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-bold mb-4">Form Penanganan Admin</h3>
        <div class="mb-4">
            <label for="nama_admin" class="block text-gray-700 font-bold mb-2">Nama Admin*</label>
            <input type="text" id="nama_admin" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border rounded-lg bg-gray-100" readonly>
        </div>
        <div class="mb-4">
            <label for="isi_penanganan" class="block text-gray-700 font-bold mb-2">Penjelasan Penanganan*</label>
            <textarea name="isi_penanganan" id="isi_penanganan" rows="5" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>{{ old('isi_penanganan') }}</textarea>
        </div>
         <div class="mb-4">
            <label for="foto_penanganan" class="block text-gray-700 font-bold mb-2">Upload Bukti Penanganan</label>
            <input type="file" name="foto_penanganan" id="foto_penanganan" class="w-full px-3 py-2 border rounded-lg">
             <p class="text-xs text-gray-500 mt-1">Format: PNG, JPG, JPEG, GIF (maksimal 5MB)</p>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Kirim</button>
        </div>
    </div>
</form>
@endsection
