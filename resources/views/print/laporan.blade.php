<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Pengaduan</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; margin: 30px; }
        .header { text-align: center; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 16pt; }
        .header p { margin: 0; font-size: 12pt; }
        .laporan { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        .laporan td { padding: 8px; vertical-align: top; }
        .laporan .label { font-weight: bold; width: 30%; }
        .section-title { font-size: 14pt; font-weight: bold; margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body onload="window.print()">

    @forelse($pengaduans as $index => $pengaduan)
    <div class="header">
        <h1>LAPORAN PENGADUAN KEKERASAN SEKSUAL</h1>
        <p>SATGAS PPKPT STMIK PPKIA PRADNYA PARAMITA MALANG</p>
    </div>

    <section>
        <h2 class="section-title">A. Detail Laporan Masuk</h2>
        <table class="laporan">
            <tr>
                <td class="label">Nomor Laporan</td>
                <td>: #{{ str_pad($pengaduan->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Laporan</td>
                <td>: {{ $pengaduan->created_at->format('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <td class="label">Judul Laporan</td>
                <td>: {{ $pengaduan->judul }}</td>
            </tr>
            <tr>
                <td class="label">Nama Pelapor</td>
                <td>: {{ $pengaduan->nama_pelapor }}</td>
            </tr>
            <tr>
                <td class="label">Kategori</td>
                <td>: {{ $pengaduan->kategori->nama_kategori }}</td>
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
        <h2 class="section-title">B. Detail Penanganan</h2>
        <table class="laporan">
             <tr>
                <td class="label">Ditangani Oleh</td>
                <td>: {{ $pengaduan->penanganan->admin->name }} (Petugas)</td>
            </tr>
            <tr>
                <td class="label">Tanggal Penanganan</td>
                <td>: {{ $pengaduan->penanganan->created_at->format('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <td class="label">Laporan Hasil Penanganan</td>
                <td>: {{ $pengaduan->penanganan->isi_penanganan }}</td>
            </tr>
        </table>
    </section>
    @endif

    <section>
        <h2 class="section-title">C. Verifikasi</h2>
        <p>Laporan ini telah diverifikasi dan ditindaklanjuti oleh Satgas PPKPT.</p>
        <table style="width: 100%; margin-top: 50px; text-align: center;">
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%;">
                    Malang, {{ now()->format('d F Y') }}<br>
                    Ketua Satgas PPKPT,<br><br><br><br><br>
                    (________________________)
                </td>
            </tr>
        </table>
    </section>

    {{-- Tambahkan page break jika bukan laporan terakhir --}}
    @if(!$loop->last)
        <div class="page-break"></div>
    @endif

    @empty
        <p>Tidak ada laporan yang dipilih untuk dicetak.</p>
    @endforelse

</body>
</html>
