<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Surat Tugas-SATGAS PPKPT-{{ str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT) }}/ST/SATGAS-PPKPT/{{ \Carbon\Carbon::now()->translatedFormat('m/Y') }}</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            margin: 30px 50px;
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

        /* surat */
        .isi-surat { margin-top: 20px; }
        .isi-surat p { text-align: justify; text-indent: 40px; margin: 10px 0; }
        .tabel-tugas { margin: 20px 40px; }
        .tanda-tangan { width: 100%; margin-top: 50px; text-align: center; border: none !important; display: flex; justify-content: end;}

        /* Detail */
        .section-title { font-size: 14px; font-weight: bold; margin-top: 20px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .detail-table { width: 100%; margin-left: 20px; font-size: 12px}
        .detail-table td { padding: 4px 0; vertical-align: top; }
        .detail-table .label { font-weight: bold; width: 30%; }

        /* Tabel */
        .content-table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        .content-table table {width: 100%;}
        .content-table th, .content-table td { border: 1px solid #ccc; padding: 8px; text-align: center;}
        .content-table th { background-color: #f2f2f2; font-weight: bold; }
        .content-table tr:nth-child(even) { background-color: #f9f9f9; }
        .page-break {
            page-break-after: always;
        }

        .tanda-tangan { width: 100%; margin-top: 50px; text-align: center; border: none !important; display: flex; justify-content: end;}

        /* Button */
        .print-button { background-color: #ff6900;}
        @media print {
            .print-button { display: none; }
        }
    </style>
</head>
<body>
    <div class="w-full px-5 py-2 flex flex-col">
        <div class="kop-surat w-full text-center flex justify-center items-center py-2 px-3 mb-5">
            <img src="https://sst.stimata.ac.id/images/stimata.jpeg" alt="Logo">
            <div class="kop-text w-full text-center flex flex-col justify-center">
                <h1>SEKOLAH TINGGI MANAJEMEN INFORMATIKA DAN KOMPUTER</h1>
                <h2>STMIK PPKIA PRADNYA PARAMITA</h2>
                <p>Kampus : Jl. Laksda Adi Sucipto No. 249-A Malang - 65141</p>
                <p>Telp. (0341) 412699, Fax. (0341) 412782</p>
                <p>Official Website : ppkpt.stimata.ac.id, E-mail : satgas-ppkpt@stimata.ac.id</p>
            </div>
        </div>
        <main class="w-full flex flex-col">
            <div class="surat-title">
                <h3>SURAT TUGAS</h3>
                <p>Nomor: {{ str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT) }}/ST/SATGAS-PPKPT/{{ \Carbon\Carbon::now()->translatedFormat('m/Y') }}</p>
            </div>

            <div class="isi-surat">
                <p>Berdasarkan laporan pengaduan yang telah diterima dan diverifikasi oleh Satuan Tugas Pencegahan dan Penanganan Kekerasan Perguruan Tinggi (Satgas PPKPT) STMIK PPKIA Pradnya Paramita, dengan ini Ketua Satgas PPKPT menugaskan kepada:</p>

                <table class="tabel-tugas">
                    <tr>
                        <td style="width: 120px;">Nama</td>
                        <td>: <strong>{{ $pengaduan->petugas->name }}</strong></td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>: Petugas Satgas PPKPT</td>
                    </tr>
                </table>

                <p>Untuk melakukan penanganan lebih lanjut terhadap laporan pengaduan dengan nomor register {{ $pengaduan->id }} mengenai dugaan kasus "{{ $pengaduan->judul }}". Penugasan ini mencakup investigasi, pendampingan, dan pelaporan hasil penanganan kepada Ketua Satgas PPKPT sesuai dengan prosedur yang berlaku.</p>

                <p>Demikian surat tugas ini dibuat untuk dapat dilaksanakan dengan sebaik-baiknya dan penuh tanggung jawab.</p>
            </div>

            <div>
                <table class="tanda-tangan">
                    <tr>
                        <td>
                            Malang, {{ now()->translatedFormat('d F Y') }}<br>
                            Ketua Satgas PPKPT,<br><br><br><br><br>
                            <strong>{{ auth()->user()->name }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </main>
    </div>
    <button class="print-button fixed px-5 py-1 top-10 right-10 rounded-lg" onclick="window.print()">Cetak</button>

</body>
</html>
