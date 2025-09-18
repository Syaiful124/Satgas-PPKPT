@extends('layouts.app')

@section('title', 'Laporan Untuk Ditangani')

@section('content')
<h1 class="text-3xl font-bold mb-6 ">Laporan Untuk Ditangani</h1>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-center">Keterangan</th>
                <th class="p-3 text-center w-[150px]">Tanggal</th>
                <th class="p-3 text-center w-[200px]">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $pengaduan)
            <tr class="border-b hover:bg-gray-300" onclick="location.href='{{ route('admin.laporan.show', $pengaduan) }}'">
                <td class="p-3 flex flex-col gap-1">
                    <h2 class="text-[16px] font-bold">{{ $pengaduan->judul }}</h2>
                    <p class="text-[14px] ">{{ $pengaduan->kategori->nama_kategori }}
                        @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                            - {{ $pengaduan->kategori_lainnya }}
                        @endif
                    </p>
                    <p class="text-[14px]">Opsi Pendampingan: {{ $pengaduan->pendampingan->opsi_pendampingan ?? 'Tidak Ada' }}</p>
                </td>
                <td class="p-3 text-center">{{ $pengaduan->created_at?->translatedFormat('d M Y') }}</td>
                <td class="p-3">
                    @if($pengaduan->penanganan)
                        <span class="text-green-600 font-semibold">Sudah Dilaporkan</span>
                    @else
                        <span class="text-red-600 font-semibold">Belum Dilaporkan</span>
                    @endif
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
