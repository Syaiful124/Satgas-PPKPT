@extends('layouts.pdf')

@section('title', 'Detail Laporan Pengaduan')

@section('content')
    @forelse($pengaduans as $pengaduan)
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="font-size: 18px; margin:0;">DETAIL LAPORAN PENGADUAN</h2>
            <p style="margin: 5px 0;">Nomor Laporan: #{{ str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>

        <section>
            <h3 class="section-title">A. Detail Laporan Masuk</h3>
            <table class="detail-table">
                <tr>
                    <td class="label">Tanggal Laporan</td>
                    <td>: {{ $pengaduan->created_at?->format('d F Y, H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">Judul Laporan</td>
                    <td>: {{ $pengaduan->judul }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Pelapor</td>
                    <td>: {{ $pengaduan->nama_pelapor ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label">Kategori</td>
                    <td>
                        : {{ $pengaduan->kategori->nama_kategori }}
                        @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                            ({{ $pengaduan->kategori_lainnya }})
                        @endif
                    </td>
                </tr>
                 <tr>
                    <td class="label">Status Akhir</td>
                    <td>: {{ strtoupper($pengaduan->status) }}</td>
                </tr>
                <tr>
                    <td class="label">Kronologi Kejadian</td>
                    <td>: {{ $pengaduan->isi_laporan }}</td>
                </tr>
            </table>
        </section>

        @if($pengaduan->penanganan)
        <section>
            <h3 class="section-title">B. Detail Penanganan</h3>
            <table class="detail-table">
                 <tr>
                    <td class="label">Ditangani Oleh</td>
                    <td>: {{ $pengaduan->penanganan->admin->name }} (Petugas)</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Penanganan</td>
                    <td>: {{ $pengaduan->penanganan->created_at?->format('d F Y, H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">Laporan Hasil Penanganan</td>
                    <td>: {{ $pengaduan->penanganan->isi_penanganan }}</td>
                </tr>
            </table>
        </section>
        @endif

        <section>
            <table style="width: 100%; margin-top: 50px; text-align: center; border: none !important;">
                <tr style="border: none !important;">
                    <td style="width: 60%; border: none !important;"></td>
                    <td style="width: 40%; border: none !important;">
                        Malang, {{ now()->format('d F Y') }}<br>
                        Ketua Satgas PPKS,<br><br><br><br><br>
                        (________________________)
                    </td>
                </tr>
            </table>
        </section>

    @empty
        <p>Laporan tidak ditemukan.</p>
    @endforelse
@endsection
