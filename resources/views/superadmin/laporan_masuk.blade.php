@extends('layouts.app')

@section('title', 'Laporan Masuk')

@section('content')
<div class="flex justify-between items-center mb-6 title-h">
    <h1 class="text-3xl font-bold">Laporan Masuk</h1>
</div>

<div class="bg-white p-4 rounded-lg shadow-md mb-4">
    <form action="{{ route('superadmin.laporan.masuk') }}" method="GET" class="flex items-center mb-4">
        <input type="text" name="search" placeholder="Cari Pengaduan" value="{{ request('search') }}" class="flex-grow p-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
        <button type="submit" class="bg-gray-700 text-white p-2 rounded-r-lg hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </button>
    </form>

    <form action="{{ route('superadmin.laporan.masuk') }}" method="GET">
        <div class="flex flex-col gap-3 items-start">
            <div class="flex gap-3">
                <div>
                    <select name="bulan" class="w-fit p-2 border rounded-lg">
                        <option value="">Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <select name="tahun" class="w-fit p-2 border rounded-lg">
                        <option value="">Tahun</option>
                        @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <select name="sort" class="w-fit p-2 border rounded-lg">
                        <option value="created_at_desc" @if(request('sort') == 'created_at_desc') selected @endif>Tanggal Terbaru</option>
                        <option value="created_at_asc" @if(request('sort') == 'created_at_asc') selected @endif>Tanggal Terlama</option>
                        <option value="status_asc" @if(request('sort') == 'status_asc') selected @endif>Status (A-Z)</option>
                        <option value="status_desc" @if(request('sort') == 'status_desc') selected @endif>Status (Z-A)</option>
                    </select>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <a href="{{ route('superadmin.laporan.masuk') }}" class="w-full block text-center bg-gray-300 text-gray-700 p-2 rounded-lg hover:bg-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </a>
                </div>
                <div class="col-span-2 md:col-span-1 items-center ">
                    <button type="submit" class="w-full bg-orange-400 text-white p-2 rounded-lg hover:bg-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

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
            <tr class="border-b hover:bg-gray-300 cursor-pointer" onclick="location.href='{{ route('superadmin.laporan.show', $pengaduan) }}'">
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
                <td class="p-3 text-center">
                    @if($pengaduan->status == 'menunggu')
                        <span class="px-3 py-1 text-sm rounded-full badge-menunggu">Menunggu</span>
                        <p class="text-xs text-gray-500">Menunggu Verifikasi</p>
                    @elseif($pengaduan->status == 'penanganan')
                        <span class="px-3 py-1 text-sm rounded-full badge-penanganan">Penanganan</span>
                        <p class="text-xs text-gray-500">
                            @if($pengaduan->penanganan)
                                Menunggu Ditindaklanjuti
                            @else
                                Menunggu Klarifikasi & Pemeriksaan Petugas
                            @endif
                        </p>
                    @endif
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
