@extends('layouts.app')

@section('title', 'Laporan Ditindaklanjuti')

@section('content')
<div class="flex justify-between items-center mb-6 title-h">
    <h1 class="text-3xl font-bold">Laporan Ditindaklanjuti</h1>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-center">Keterangan</th>
                <th class="p-3 text-center w-[150px]">Tanggal Lapor</th>
                <th class="p-3 text-center w-[150px]">Tanggal Ditindaklanjuti</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $pengaduan)
            <tr class="border-b hover:bg-gray-300" onclick="location.href='{{ route('superadmin.laporan.show', $pengaduan) }}'">
                <td class="p-3 flex flex-col gap-1">
                    <h2 class="text-[16px] font-bold">{{ $pengaduan->judul }}</h2>
                    <p class="text-[12px] text-gray-600">
                        {{ $pengaduan->nama_pelapor ?? 'Anonim' }}
                        | {{ $pengaduan->kategori->nama_kategori }}
                        @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                            - {{ $pengaduan->kategori_lainnya }}
                        @endif
                    </p>
                    <p class="text-[12px] text-gray-600">
                        {{ $pengaduan->pendampingan->opsi_pendampingan }}
                        | {{ $pengaduan->penanganan->tindaklanjut->opsi_tindaklanjut ?? 'Belum Ditindaklanjuti' }}
                    </p>
                </td>
                <td class="p-3 text-center">{{ $pengaduan->created_at?->translatedFormat('d-m-Y') }}</td>
                <td class="p-3 text-center">{{ $pengaduan->updated_at?->translatedFormat('d-m-Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">Belum ada laporan yang Ditindaklanjuti.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $pengaduans->links() }}</div>
@endsection
