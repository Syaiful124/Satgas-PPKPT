@extends('layouts.pdf')

@section('title', 'Rekap Laporan Pengaduan')

@section('content')
    <div style="text-align: center; margin-bottom: 25px;">
        <h2 style="font-size: 18px; margin:0;">REKAP LAPORAN PENGADUAN</h2>
        <p style="margin: 5px 0;">Dicetak pada: {{ now()->format('d F Y') }}</p>
    </div>

    <table class="content-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Judul Laporan</th>
                <th>Pelapor</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tanggal Lapor</th>
                <th>Dotangani Oleh</th>
                <th>Tanggal Ditangani</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduans as $index => $pengaduan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pengaduan->judul }}</td>
                    <td>{{ $pengaduan->nama_pelapor ?? 'N/A' }}</td>
                    <td>
                        {{ $pengaduan->kategori->nama_kategori }}
                        @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                            ({{ $pengaduan->kategori_lainnya }})
                        @endif
                    </td>
                    <td>{{ ucfirst($pengaduan->status) }}</td>
                    <td>{{ $pengaduan->created_at?->format('d-m-Y') }}</td>
                    <td>
                        {{ $pengaduan->penanganan?->admin?->name ?? '-' }}
                    </td>
                    <td>
                        {{ $pengaduan->penanganan?->created_at?->format('d-m-Y') ?? '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data untuk ditampilkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
