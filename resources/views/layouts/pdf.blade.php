<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') - SATGAS PPKPT - @yield('nomor')</title>
    <link rel="icon" type="image/png" href="https://stimata.ac.id/media/2023/01/ICON-STIMATA-1536x1536.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            margin: 10cm 10cm 10cm 20cm;
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
            @yield('content')
        </main>
    </div>
    <button class="print-button fixed px-5 py-1 top-10 right-10 rounded-lg" onclick="window.print()">Cetak</button>
</body>
</html>
