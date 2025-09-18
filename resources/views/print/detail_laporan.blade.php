<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Laporan - SATGAS PPKPT - {{ str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT) }}</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            margin: 50px 40px ;
        }
        body { font-family: 'Times New Roman', Times, serif; font-size: 12pt; line-height: 1.5;}

        /* Header */
        .kop-surat {text-align: center; border-bottom: 4px double black;}
        .kop-surat img { height: 100px; width: auto; }
        .kop-surat h1 { font-size: 12pt; margin: 0; font-weight: bold; letter-spacing: 1px;}
        .kop-surat h2 { font-size: 12pt; margin: 0; font-weight: bold; }
        .kop-surat p { font-size: 10pt; margin: 0; line-height: 1.2; }
        .surat-title { text-align: center; margin-bottom: 10px; font-weight: bold; }
        .surat-title h3 { text-decoration: underline; margin: 0; font-size: 14pt; }
        .surat-title p { margin: 0; font-weight: normal;}

        /* Detail */
        .section-title { font-size: 14px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .detail-table { width: 100%; margin-left: 20px; font-size: 12px}
        .detail-table td { padding: 4px 0; vertical-align: top; }
        .detail-table .label { font-weight: bold; width: 30%; }

        .tanda-tangan { width: 100%; margin-top: 50px; text-align: center; border: none !important; display: flex; justify-content: end;}

        footer {
            position: fixed;
            bottom: 0.5cm;
            left: 1.5cm;
            right: 1.5cm;
            height: 1cm;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 5px;
            font-family: Arial, sans-serif;
            font-size: 9pt;
        }
        /* Logika untuk menampilkan nomor halaman (contoh: Halaman 1 dari 5) */
        footer .page-number::before {
            content: "Halaman " counter(page);
        }
        /* Button */
        .print-button { background-color: #ff6900; color: white;}
        @media print {
            .print-button { display: none; }
        }
    </style>
</head>
<body>
    <div class="w-full px-5 py-2 flex flex-col">
        <div class="kop-surat w-full text-center flex justify-center items-center py-2 px-3 mb-10">
            <img src="https://sst.stimata.ac.id/images/stimata.jpeg" alt="Logo">
            <div class="kop-text w-full text-center flex flex-col justify-center">
                <h1>SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER</h1>
                <h2>STMIK PPKIA PRADNYA PARAMITA</h2>
                <p>Kampus : Jl. Laksda Adi Sucipto No. 249-A Malang - 65141</p>
                <p>Telp. (0341) 412699, Fax. (0341) 412782</p>
                <p>Official Website : satgas-ppkpt-stimata.ac.id E-mail : satgas-ppkpt@stimata.ac.id</p>
            </div>
        </div>
        <main class="w-full flex flex-col">
            <div class="surat-title">
                <h3>DETAIL LAPORAN PENGADUAN</h3>
                <p>Nomor Laporan: {{ str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div>
                <h3 class="section-title">A. Detail Laporan Masuk</h3>
                <table class="detail-table">
                    <tr>
                        <td class="label">Tanggal Laporan</td>
                        <td>: {{ $pengaduan->created_at?->translatedFormat('d F Y, H:i') }}</td>
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
            </div>
            @if($pengaduan->penanganan)
            <div>
                <h3 class="section-title">B. Detail Penanganan</h3>
                <table class="detail-table">
                    <tr>
                        <td class="label">Ditangani Oleh</td>
                        <td>: {{ $pengaduan->penanganan->admin->name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tanggal Penanganan</td>
                        <td>: {{ $pengaduan->penanganan->created_at?->translatedFormat('d F Y, H:i') }}</td>
                    </tr>
                    <tr>
                        <td class="label">Laporan Hasil Penanganan</td>
                        <td>: {{ $pengaduan->penanganan->isi_penanganan }}</td>
                    </tr>
                </table>
            </div>
            @endif
            @if ($pengaduan->status == 'ditolak' && !empty($pengaduan->alasan_penolakan))
            <div>
                <h3 class="section-title">{{ $pengaduan->penanganan ? 'C. Hasil Akhir' : 'B. Hasil Akhir' }}: Laporan Ditolak</h3>
                <table class="detail-table">
                    <tr>
                        <td class="label" style="vertical-align: top; color: #dc2626;">Alasan Penolakan</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="white-space: pre-wrap;">{{ $pengaduan->alasan_penolakan }}</td>
                    </tr>
                </table>
            </div>
            @endif
            <div>
                <table class="tanda-tangan">
                    <tr>
                        <td>
                            Malang, {{ now()->translatedFormat('d F Y') }}<br>
                            Ketua Satgas PPKS,<br><br><br><br><br>
                            <strong>{{ auth()->user()->name }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <button class="print-button fixed px-5 py-1 top-10 right-10 rounded-lg" onclick="window.print()">Cetak</button>
</body>
</html>
