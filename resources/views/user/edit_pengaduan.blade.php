@extends('layouts.public')
@section('title', 'Edit Pengaduan')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Pengaduan</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('account.pengaduan.update', $pengaduan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-bold mb-2">Judul Pengaduan*</label>
            <input type="text" name="judul" value="{{ old('judul', $pengaduan->judul) }}" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="kategori_id" class="block text-gray-700 font-bold mb-2">Kategori Pengaduan*</label>
            <select name="kategori_id" class="w-full px-3 py-2 border rounded-lg" required>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" @if(old('kategori_id', $pengaduan->kategori_id) == $kategori->id) selected @endif>{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
             <label for="isi_laporan" class="block text-gray-700 font-bold mb-2">Kronologi Kejadian*</label>
             <textarea name="isi_laporan" rows="8" class="w-full px-3 py-2 border rounded-lg" required>{{ old('isi_laporan', $pengaduan->isi_laporan) }}</textarea>
        </div>

        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('account.pengaduan.show', $pengaduan) }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400">Batal</a>
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
