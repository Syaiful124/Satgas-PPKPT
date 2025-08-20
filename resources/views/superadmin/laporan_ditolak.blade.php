@extends('layouts.app')

@section('title', 'Laporan Ditolak')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Laporan Ditolak</h1>
    <a href="{{ route('superadmin.dashboard.export.pdf', request()->query()) }}" class="bg-red-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-red-700">
        Export ke PDF
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">Judul</th>
                <th class="p-3 text-left">Kategori</th>
                <th class="p-3 text-left">Tanggal Lapor</th>
                <th class="p-3 text-left">Tanggal Ditolak</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $pengaduan)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $pengaduan->judul }}</td>
                <td class="p-3">{{ $pengaduan->kategori->nama_kategori }}</td>
                <td class="p-3">{{ $pengaduan->created_at?->format('d M Y') }}</td>
                <td class="p-3">{{ $pengaduan->updated_at?->format('d M Y') }}</td>
                <td class="p-3">
                     <a href="{{ route('superadmin.laporan.show', $pengaduan) }}" class="text-blue-500 hover:underline">Lihat Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada laporan yang ditolak.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $pengaduans->links() }}</div>
@endsection
