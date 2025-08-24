@extends('layouts.pdf')

@section('title', 'Surat Tugas')
@section('nomor', str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT))

@section('content')
    <div class="surat-title">
        <h3>SURAT TUGAS</h3>
        <p>Nomor Surat: {{ str_pad($pengaduan->id, 3, '0', STR_PAD_LEFT) }}/ST/SATGAS-PPKPT/{{ \Carbon\Carbon::now()->translatedFormat('m/Y') }}</p>
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
@endsection
