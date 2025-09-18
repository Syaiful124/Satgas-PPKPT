@extends('layouts.pdf')

@section('title', 'Rekap Laporan')
@section('nomor', now()->translatedFormat('d F Y'))

@section('content')
    <div class="surat-title">
        <h3>REKAP LAPORAN PENGADUAN</h3>
        <p>Dicetak pada: {{ now()->translatedFormat('d F Y') }}</p>
    </div>

    <div class="content-table">
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>Judul Laporan</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal Lapor</th>
                    <th>Tanggal Ditangani</th>
                    <th>Ditangani Oleh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengaduans as $index => $pengaduan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pengaduan->judul }}</td>
                        <td>{{ $pengaduan->kategori->nama_kategori }}
                            @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                                ({{ $pengaduan->kategori_lainnya }})
                            @endif
                        </td>
                        <td>{{ ucfirst($pengaduan->status) }}</td>
                        <td>{{ $pengaduan->created_at?->translatedFormat('d-m-Y') }}</td>
                        <td>{{ $pengaduan->penanganan?->created_at->translatedFormat('d-m-Y') ?? '-' }}</td>
                        <td>{{ $pengaduan->petugas?->name ?? ($pengaduan->penanganan?->admin?->name ?? '-') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak ada data untuk ditampilkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @foreach ($pengaduans as $pengaduan)
        <div class="page-break"></div>
        @include('print.detail_laporan', ['pengaduans' => collect([$pengaduan])])
    @endforeach
@endsection
