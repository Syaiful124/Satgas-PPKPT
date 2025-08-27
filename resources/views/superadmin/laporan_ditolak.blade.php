@extends('layouts.app')

@section('title', 'Laporan Ditolak')

@section('content')
<div class="flex justify-between items-center mb-6 title-h">
    <h1 class="text-3xl font-bold">Laporan Ditolak</h1>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-center ">Judul</th>
                <th class="p-3 text-center w-[150px]">Tanggal Lapor</th>
                <th class="p-3 text-center w-[150px]">Tanggal Ditolak</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $pengaduan)
            <tr class="border-b hover:bg-gray-300" onclick="location.href='{{ route('superadmin.laporan.show', $pengaduan) }}'">
                <td class="p-3 flex flex-col gap-1">
                    <h2 class="text-[16px] font-bold">{{ $pengaduan->judul }}</h2>
                    <p class="text-[14px] ">{{ $pengaduan->kategori->nama_kategori }} {{ $pengaduan->kategori_lainnya }}</p>
                </td>
                <td class="p-3 text-center">{{ $pengaduan->created_at?->translatedFormat('d M Y') }}</td>
                <td class="p-3 text-center">{{ $pengaduan->updated_at?->translatedFormat('d M Y') }}</td>
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
