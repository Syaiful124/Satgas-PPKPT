@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-6 title-h w-full">
    <h1 class="text-3xl font-bold">Dashboard</h1>
        <a href="{{ route('superadmin.dashboard.export.pdf', request()->query()) }}" target="_blank" class="ml-10 flex items-center gap-1 bg-orange-300 font-semibold px-5 py-2 rounded-lg hover:bg-orange-500 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
            </svg>
            Print
        </a>
</div>

<div class="flex justify-center items-center gap-6 mb-4 text-center w-full">
    <div class="jml-b bg-blue-200 text-black p-3 rounded-lg shadow-md w-full">
        <p class="text-lg">Laporan Masuk</p>
        <p class="text-2xl md:text-4xl font-bold">{{ $stats['masuk'] }}</p>
    </div>
    <div class="jml-g bg-green-200 text-black p-3 rounded-lg shadow-md w-full">
        <p class="text-lg">Selesai</p>
        <p class="text-2xl md:text-4xl font-bold">{{ $stats['selesai'] }}</p>
    </div>
    <div class="jml-r bg-red-200 text-black p-3 rounded-lg shadow-md w-full">
        <p class="text-lg">Ditolak</p>
        <p class="text-2xl md:text-4xl font-bold">{{ $stats['ditolak'] }}</p>
    </div>
</div>

<div class="bg-white p-4 rounded-lg shadow-md mb-4 ">
    <form action="{{ route('superadmin.dashboard') }}" method="GET" class="flex items-center mb-4 flex justify-between">
        <input type="text" name="search" placeholder="Cari Pengaduan" value="{{ request('search') }}" class="flex-grow p-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
        <button type="submit" class="bg-gray-400 text-white p-2 rounded-r-lg hover:bg-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </button>
    </form>

    <form action="{{ route('superadmin.dashboard') }}" method="GET">
        <div class="flex flex-wrap gap-3 min-w-screen">
            <div>
                <select name="status" class=" p-2 border rounded-lg cursor-pointer">
                    <option value="">Pilih Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="penanganan" {{ request('status') == 'penanganan' ? 'selected' : '' }}>Penanganan</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div>
                <select name="kategori" class=" p-2 border rounded-lg cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="pendampingan" class="p-2 border rounded-lg cursor-pointer">
                    <option value="">Semua Pendampingan</option>
                    @foreach($pendampingans as $pendampingan)
                    <option value="{{ $pendampingan->id }}" {{ request('pendampingan') == $pendampingan->id ? 'selected' : '' }}>{{ $pendampingan->opsi_pendampingan }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="tindaklanjut" class="p-2 border rounded-lg cursor-pointer">
                    <option value="">Semua Tindak Lanjut</option>
                    @foreach($tindaklanjuts as $tindaklanjut)
                        <option value="{{ $tindaklanjut->id }}" {{ request('tindaklanjut') == $tindaklanjut->id ? 'selected' : '' }}>
                            {{ $tindaklanjut->opsi_tindaklanjut }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="bulan" class=" p-2 border rounded-lg cursor-pointer">
                    <option value="">Bulan</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <select name="tahun" class=" p-2 border rounded-lg cursor-pointer">
                    <option value="">Tahun</option>
                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <select name="sort" class="w-fit p-2 border rounded-lg cursor-pointer">
                    <option value="created_at_desc" @if(request('sort') == 'created_at_desc') selected @endif>Tanggal Terbaru</option>
                    <option value="created_at_asc" @if(request('sort') == 'created_at_asc') selected @endif>Tanggal Terlama</option>
                    <option value="status_asc" @if(request('sort') == 'status_asc') selected @endif>Status (A-Z)</option>
                    <option value="status_desc" @if(request('sort') == 'status_desc') selected @endif>Status (Z-A)</option>
                </select>
            </div>
            <div class="col-span-2 md:col-span-1">
                <a href="{{ route('superadmin.dashboard') }}" class="w-full block text-center bg-gray-300 p-2 rounded-lg hover:bg-gray-500 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </a>
            </div>
            <div class="col-span-2 md:col-span-1 items-center ">
                <button type="submit" class="w-full bg-orange-300 p-2 rounded-lg hover:bg-orange-500 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>


<div class="bg-white p-0 m-0 rounded-lg shadow-md overflow-hidden flex">
    <table class="w-full p-3">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-center ">Keterangan</th>
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
                    @elseif($pengaduan->status == 'selesai')
                        <span class="px-3 py-1 text-sm rounded-full badge-selesai">Selesai</span>
                    @elseif($pengaduan->status == 'ditolak')
                        <span class="px-3 py-1 text-sm rounded-full badge-ditolak">Ditolak</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">Tidak ada data laporan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $pengaduans->withQueryString()->links() }}
</div>

@endsection
