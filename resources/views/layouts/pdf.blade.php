<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title> @yield('title') - SATGAS PPKPT</title>
    <link rel="icon" type="image/png" href="https://stimata.ac.id/media/2023/01/ICON-STIMATA-1536x1536.png">
    <style>
        /* CSS untuk tampilan PDF yang rapi */
        @page {
            margin: 0cm 0cm;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            margin: 2.7cm 1.5cm 2cm 1.5cm;
            color: #333;
        }
        header {
            position: fixed;
            top: 0.75cm;
            left: 1.5cm;
            right: 1.5cm;
            height: 2cm;
            text-align: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        header .logo {
            width: 70px; /* Sesuaikan ukuran logo */
            height: 70px;
            float: left;
        }
        header .header-text {
            float: left;
            margin-left: 20px;
            text-align: left;
        }
        header h1 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }
        header p {
            margin: 3px 0;
            font-size: 12px;
        }
        footer {
            position: fixed;
            bottom: 0.5cm;
            left: 1.5cm;
            right: 1.5cm;
            height: 1cm;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
        footer .page-number:before {
            content: "Halaman " counter(page);
        }
        main {
            position: relative;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .content-table th, .content-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .content-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .content-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .detail-table {
            width: 100%;
        }
        .detail-table td {
            padding: 4px 0;
            vertical-align: top;
        }
        .detail-table .label {
            font-weight: bold;
            width: 30%;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
        <div class="header-text">
            <h1>SATUAN TUGAS PENCEGAHAN DAN PENANGANAN KEKERASAN SEKSUAL (SATGAS PPKS)</h1>
            <p>STMIK PPKIA PRADNYA PARAMITA MALANG</p>
        </div>
    </header>

    <footer>
        <div class="page-number"></div>
    </footer>

    <main>
        @yield('content')
    </main>
</body>
</html>
