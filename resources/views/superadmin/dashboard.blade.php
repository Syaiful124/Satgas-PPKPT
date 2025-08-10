@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Dashboard</h1>
    <button class="bg-orange-400 text-white px-4 py-2 rounded-lg hover:bg-orange-500">Export</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-blue-400 text-white p-6 rounded-lg shadow-md">
        <p class="text-lg">Laporan Masuk</p>
        <p class="text-4xl font-bold">{{ $stats['masuk'] }}</p>
    </div>
    <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
        <p class="text-lg">Selesai</p>
        <p class="text-4xl font-bold">{{ $stats['selesai'] }}</p>
    </div>
    <div class="bg-red-500 text-white p-6 rounded-lg shadow-md">
        <p class="text-lg">Ditolak</p>
        <p class="text-4xl font-bold">{{ $stats['ditolak'] }}</p>
    </div>
</div>

<div class="bg-white p-4 rounded-lg shadow-md mb-6">
    <form action="{{ route('superadmin.dashboard') }}" method="GET" class="flex items-center mb-4">
        <input type="text" name="search" placeholder="Cari Pengaduan" value="{{ request('search') }}" class="flex-grow p-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
        <button type="submit" class="bg-gray-700 text-white p-2 rounded-r-lg hover:bg-gray-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </button>
    </form>

    <form action="{{ route('superadmin.dashboard') }}" method="GET">
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4 items-end">
            <div>
                <label class="text-sm">Status</label>
                <select name="status" class="w-full p-2 border rounded-lg">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="penanganan" {{ request('status') == 'penanganan' ? 'selected' : '' }}>Penanganan</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div>
                <label class="text-sm">Kategori</label>
                <select name="kategori" class="w-full p-2 border rounded-lg">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm">Bulan</label>
                <select name="bulan" class="w-full p-2 border rounded-lg">
                    <option value="">--</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->format('F') }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="text-sm">Tahun</label>
                <select name="tahun" class="w-full p-2 border rounded-lg">
                    <option value="">--</option>
                    @for ($i = date('Y'); $i >= date('Y') - 5; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-span-2 md:col-span-1">
                <button type="submit" class="w-full bg-orange-400 text-white p-2 rounded-lg hover:bg-orange-500">Filter</button>
            </div>
            <div class="col-span-2 md:col-span-1">
                <a href="{{ route('superadmin.dashboard') }}" class="w-full block text-center bg-gray-300 text-gray-700 p-2 rounded-lg hover:bg-gray-400">Reset</a>
            </div>
        </div>
    </form>
</div>


<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">Judul</th>
                <th class="p-3 text-left">Kategori</th>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Status</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $pengaduan)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $pengaduan->judul }}</td>
                <td class="p-3">{{ $pengaduan->kategori->nama_kategori }}</td>
                <td class="p-3">{{ $pengaduan->created_at->format('d M Y') }}</td>
                <td class="p-3">
                    <span class="px-3 py-1 text-sm rounded-full
                        @if($pengaduan->status == 'menunggu') badge-menunggu @endif
                        @if($pengaduan->status == 'penanganan') badge-penanganan @endif
                        @if($pengaduan->status == 'selesai') badge-selesai @endif
                        @if($pengaduan->status == 'ditolak') badge-ditolak @endif
                    ">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </td>
                <td class="p-3">
                     <a href="{{ route('superadmin.laporan.show', $pengaduan) }}" class="text-blue-500 hover:underline">Lihat Detail</a>
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
    {{ $pengaduans->links() }}
</div>

@endsection
