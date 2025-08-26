@extends('layouts.app')

@section('title', 'Laporan Masuk')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Laporan Masuk</h1>
    {{-- Tombol print bisa ditambahkan di sini jika diperlukan --}}
</div>

<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <form action="{{ route('superadmin.laporan.masuk') }}" method="GET" class="flex items-center">
        <input type="text" name="search" placeholder="Cari Pengaduan..." value="{{ request('search') }}" class="flex-grow p-2 border rounded-l-lg focus:outline-none">
        <button type="submit" class="bg-gray-700 text-white p-2 rounded-r-lg hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </button>
    </form>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-center">Judul</th>
                <th class="p-3 text-center">Kategori</th>
                <th class="p-3 text-center">Tanggal</th>
                <th class="p-3 text-center">Status</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $pengaduan)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-semibold">{{ $pengaduan->judul }}</td>
                <td class="p-3">{{ $pengaduan->kategori->nama_kategori }}</td>
                <td class="p-3 text-center">{{ $pengaduan->created_at?->translatedFormat('d M Y') }}</td>
                <td class="p-3 text-center">
                    @if($pengaduan->status == 'menunggu')
                        <span class="px-3 py-1 text-sm rounded-full badge-menunggu">Menunggu</span>
                        <p class="text-xs text-gray-500">Menunggu persetujuan</p>
                    @elseif($pengaduan->status == 'penanganan')
                        <span class="px-3 py-1 text-sm rounded-full badge-penanganan">Penanganan</span>
                        <p class="text-xs text-gray-500">
                            @if($pengaduan->penanganan)
                                Menunggu konfirmasi Anda
                            @else
                                Menunggu laporan admin
                            @endif
                        </p>
                    @endif
                </td>
                <td class="p-3 text-center">
                     <a href="{{ route('superadmin.laporan.show', $pengaduan) }}" class="text-blue-500 hover:underline">Lihat Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada laporan masuk saat ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $pengaduans->links() }}
</div>
@endsection
