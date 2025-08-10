@extends('layouts.app')

@section('title', 'Laporan Untuk Ditangani')

@section('content')
<h1 class="text-3xl font-bold mb-6">Laporan Untuk Ditangani</h1>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">Judul</th>
                <th class="p-3 text-left">Kategori</th>
                <th class="p-3 text-left">Tanggal Disetujui</th>
                <th class="p-3 text-left">Status Penanganan</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $pengaduan)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-semibold">{{ $pengaduan->judul }}</td>
                <td class="p-3">{{ $pengaduan->kategori->nama_kategori }}</td>
                <td class="p-3">{{ $pengaduan->updated_at->format('d M Y') }}</td>
                <td class="p-3">
                    @if($pengaduan->penanganan)
                        <span class="text-green-600 font-semibold">Sudah Dilaporkan</span>
                    @else
                        <span class="text-red-600 font-semibold">Belum Dilaporkan</span>
                    @endif
                </td>
                <td class="p-3">
                     <a href="{{ route('admin.laporan.show', $pengaduan) }}" class="text-blue-500 hover:underline">
                        {{ $pengaduan->penanganan ? 'Lihat/Edit Laporan' : 'Tangani & Lapor' }}
                     </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada laporan yang perlu ditangani saat ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $pengaduans->links() }}
</div>
@endsection
