<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Rekap Laporan-SATGAS PPKPT-{{ now()->translatedFormat('d F Y') }}</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* surat */
        .isi-surat { margin-top: 20px; }
        .isi-surat p { text-align: justify; text-indent: 40px; margin: 10px 0; }
        .tabel-tugas { margin: 20px 40px; }
        .tanda-tangan { width: 100%; margin-top: 50px; text-align: center; border: none !important; display: flex; justify-content: end;}

        /* Tabel */
        .content-table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        .content-table table {width: 100%;}
        .content-table th, .content-table td { border: 1px solid #000; padding: 8px; text-align: center;}
        .content-table th { background-color: #b2b2b2; font-weight: bold; }
        .content-table tr:nth-child(even) { background-color: #ffff; }
        .page-break {
            page-break-after: always;
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
                <h3>REKAP LAPORAN</h3>
                {{-- <p>Dicetak pada: {{ now()->translatedFormat('d F Y') }}</p> --}}
            </div>

            <div class="content-table">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Keterangan</th>
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
                                <td>{{ $pengaduan->judul }}
                                    <br>{{ $pengaduan->kategori->nama_kategori }}
                                    @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                                        ({{ $pengaduan->kategori_lainnya }})
                                    @endif
                                </td>
                                <td>{{ ucfirst($pengaduan->status) }}</td>
                                <td>{{ $pengaduan->created_at?->translatedFormat('d F Y') }}</td>
                                <td>{{ $pengaduan->penanganan?->created_at->translatedFormat('d F Y') ?? '-' }}</td>
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
    @foreach ($pengaduans as $pengaduan)
        <div class="page-break"></div>
        @include('print.detail_laporan', ['pengaduans' => collect([$pengaduan])])
    @endforeach
    <button class="print-button fixed px-5 py-1 top-10 right-10 rounded-lg" onclick="window.print()">Cetak</button>
</body>
</html>
