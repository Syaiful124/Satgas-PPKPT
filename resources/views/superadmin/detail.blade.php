@extends('layouts.app')

@section('title', 'Detail Laporan Pengaduan')

@section('content')
<div class="flex items-center gap-4 mb-4 title-h">
    <a href="{{ route('account.index') }}" class="text-[20px] text-gray-600 hover:text-gray-900 inline-block ">&larr; </a>
    <h1 class="text-3xl font-bold">Detail Laporan</h1>
</div>

<div class="flex flex-col gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4 border-b pb-2">Laporan Pengaduan</h2>
        <div class="flex flex-col gap-4">
            <div class="flex flex-row gap-4 w-full">
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Pelapor</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->nama_pelapor ?? 'Anonim' }}</p>
                </div>
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Tanggal Dilaporkan</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->created_at?->translatedFormat('d F Y, H:i') }}</p>
                </div>
            </div>
            @if (!empty($pengaduan->email_pelapor) || !empty($pengaduan->telepon_pelapor))
                <div class="flex flex-row gap-4 w-full">
                    @if (!empty($pengaduan->email_pelapor))
                        <div class="w-full">
                            <p class="text-[16px] font-semibold">Email Pelapor</p>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->email_pelapor }}</p>
                        </div>
                    @endif
                    @if (!empty($pengaduan->telepon_pelapor))
                        <div class="w-full">
                            <p class="text-[16px] font-semibold">Telepon Pelapor</p>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->telepon_pelapor }}</p>
                        </div>
                    @endif
                </div>
            @endif
            <div class="w-full">
                <p class="text-[16px] font-semibold">Judul Laporan</p>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->judul }}</p>
            </div>
            <div class="flex gap-4 w-full">
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Kategori</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->kategori->nama_kategori }}</p>
                    @if ($pengaduan->kategori->nama_kategori == 'Lainnya' && !empty($pengaduan->kategori_lainnya))
                        <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->kategori_lainnya }}</p>
                    @endif
                </div>
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Pendampingan</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->pendampingan->opsi_pendampingan }}</p>
                </div>
            </div>
            <div>
                <p class="text-[16px] font-semibold">Kronologi Kejadian</p>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->isi_laporan }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="text-[16px] font-semibold">Bukti Kejadian</h3>
                @if ($pengaduan->bukti->isNotEmpty())
                    <div class="grid grid-cols-3 gap-2 min-h-[100px] max-h-[215px] overflow-y-auto border-lg rounded-lg bg-gray-100 p-2">
                        @foreach($pengaduan->bukti as $bukti)
                            <a href="{{ Storage::url($bukti->file_path) }}" target="_blank" class="block transform hover:scale-auto transition-transform duration-300">
                                @if($bukti->file_type == 'image')
                                    <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full max-h-[200px] rounded-lg shadow">
                                @else
                                    <video src="{{ Storage::url($bukti->file_path) }}" controls class="w-full max-h-[200px] rounded-lg shadow"></video>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">
                        Tidak ada bukti yang dilampirkan.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md gap-4 flex flex-col">
        <h2 class="text-2xl font-semibold border-b pb-2">Laporan Penanganan</h2>
        @if ($pengaduan->penanganan)
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-[16px] font-semibold">Ditangani oleh Petugas</p>
                    <p class="ftext-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->admin->name }}</p>
                </div>
                <div>
                    <p class="text-[16px] font-semibold">Tanggal Ditangani</p>
                    <p class="ftext-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->created_at?->translatedFormat('d M Y, H:i') }}</p>
                </div>
            </div>
            <div >
                <p class="text-[16px] font-semibold">Tindak Lanjut</p>
                <p class="ftext-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->tindaklanjut->opsi_tindaklanjut }}</p>
            </div>
            <div>
                <p class="text-[16px] font-semibold">Isi Laporan Penanganan</p>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->penanganan->isi_penanganan }}</p>
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="text-[16px] font-semibold">Bukti Penanganan</h3>
                @if ($pengaduan->penanganan && $pengaduan->penanganan->bukti->isNotEmpty())
                <div class="grid grid-cols-3 gap-2 min-h-[100px] max-h-[215px] overflow-y-auto border-lg rounded-lg bg-gray-100 p-2">
                    @foreach($pengaduan->penanganan->bukti as $bukti)
                        <a href="{{ Storage::url($bukti->file_path) }}" target="_blank" class="block transform hover:scale-auto transition-transform duration-300">
                            @if($bukti->file_type == 'image')
                                <img src="{{ Storage::url($bukti->file_path) }}" alt="{{ $bukti->file_name }}" class="w-full max-h-[200px] rounded-lg shadow">
                            @else
                                <video src="{{ Storage::url($bukti->file_path) }}" controls class="w-full max-h-[200px] rounded-lg shadow"></video>
                            @endif
                        </a>
                    @endforeach
                </div>
                @else
                    <div class="border-2 border-dashed rounded-lg p-10 text-center text-gray-400">
                        Tidak ada bukti yang dilampirkan.
                    </div>
                @endif
            </div>
        @else
            <div class="text-center text-gray-500 py-8">
                <p>Belum ada laporan penanganan dari petugas.</p>
            </div>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md gap-4 flex flex-col">
        <h2 class="text-2xl font-semibold border-b pb-2">Hasil Akhir</h2>
        <div class="flex flex-row gap-4">
            <div class="w-full">
                <p class="text-[16px] font-semibold">Status Saat Ini</p>
                @if($pengaduan->status == 'menunggu')
                    <p class="text-orange-500">Menunggu</p>
                    <p class="text-xs text-gray-500">Menunggu Verifikasi</p>
                @elseif($pengaduan->status == 'penanganan')
                    <p class="text-blue-500">Penanganan</p>
                    <p class="text-xs text-gray-500">
                        @if($pengaduan->penanganan)
                            Menunggu Ditindaklanjuti
                        @else
                            Menunggu Klarifikasi & Pemeriksaan Petugas
                        @endif
                    </p>
                @elseif($pengaduan->status == 'selesai')
                    <p class="text-green-500">Selesai</p>
                @elseif($pengaduan->status == 'ditolak')
                    <p class="text-red-500">Ditolak</p>
                @endif
            </div>

            @if ($pengaduan->status == 'ditolak' && $pengaduan->alasan_penolakan)
                <div class="w-full">
                    <p class="text-[16px] font-semibold">Alasan Penolakan:</p>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $pengaduan->alasan_penolakan }}</p>
                </div>
            @endif

            @if($pengaduan->status == 'selesai' && !empty($pengaduan->layanan_pemulihan))
            <div class="w-full">
                <p class="text-[16px] font-semibold">Layanan Pemulihan Diberikan</p>
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach($pengaduan->layanan_pemulihan as $layanan)
                        <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full">{{ ucfirst($layanan) }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="flex flex-col rounded-lg shadow-md fixed top-20 md:top-4 right-4 w-30 overflow-hidden" id="accordion-container">
        <button class="accordion-header w-full flex justify-between items-center p-4 text-left font-semibold bg-orange-300 hover:bg-orange-500 hover:text-white">
            <span class="text-center text-2xl font-semibold">Panel Aksi</span>
            <svg class="accordion-arrow w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </button>
        <div class="accordion-content hidden border-t bg-gray-100 p-4 ">
            @if ($pengaduan->petugas_id)
                <div class="text-center mb-4">
                    <a href="{{ route('superadmin.surat.penugasan', $pengaduan) }}" target="_blank" class="w-full block bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-gray-700">
                        Cetak Surat Tugas
                    </a>
                </div>
                @if($pengaduan->status != 'menunggu')
                    <hr class="my-4">
                @endif
            @endif
            @switch($pengaduan->status)
                @case('menunggu')
                    <form action="{{ route('superadmin.laporan.setujui', $pengaduan) }}" target="_blank" method="POST" class="mb-4 flex flex-col gap-2 items-center">
                        @csrf
                        <label for="petugas_id" class="block font-semibold text-center">Tugaskan kepada :</label>
                        <select name="petugas_id" id="petugas_id" class="w-full p-2 border rounded-lg text-center cursor-pointer" required>
                            <option value="">-- Pilih Petugas --</option>
                            @foreach ($petugas_list as $petugas)
                                <option value="{{ $petugas->id }}">{{ $petugas->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full btn-primary px-6 py-2 rounded-lg text-black hover:text-white hover:bg-orange-500">Buat Surat Tugas</button>
                    </form>
                    <div class="my-4 flex items-center">
                        <hr class="flex-grow border-t">
                        <span class="px-2 text-xs text-gray-500">ATAU</span>
                        <hr class="flex-grow border-t">
                    </div>
                    <button onclick="document.getElementById('modal-tolak').classList.remove('hidden')" class="w-full btn-danger px-4 py-2 rounded-lg text-black hover:text-white">Tolak Laporan</button>

                    <div id="modal-tolak" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
                            <h3 class="text-xl font-bold mb-4">Alasan Penolakan</h3>
                            <form action="{{ route('superadmin.laporan.tolak', $pengaduan) }}" method="POST">
                                @csrf
                                <textarea name="alasan_penolakan" rows="5" class="w-full p-2 border rounded-lg mb-4" placeholder="Tuliskan alasan mengapa laporan ini ditolak..." required minlength="10"></textarea>
                                <div class="flex justify-end space-x-4">
                                    <button type="button" onclick="document.getElementById('modal-tolak').classList.add('hidden')" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">Batal</button>
                                    <button type="submit" class="btn-danger px-4 py-2 rounded-lg">Kirim Penolakan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @break

                @case('penanganan')
                    @if ($pengaduan->penanganan)
                        <p class="text-sm text-center text-gray-600 mb-4">Petugas telah mengirim laporan penanganan. Konfirmasi jika laporan sudah selesai.</p>
                        <div class="text-center">
                            <button type="button" onclick="document.getElementById('modal-selesai').classList.remove('hidden')" class="btn-success w-full px-6 py-2 rounded-lg">
                                Konfirmasi Selesai
                            </button>
                        </div>

                        <div id="modal-selesai" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                            <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-lg">
                                <h3 class="text-xl font-bold mb-4">Konfirmasi Penyelesaian Laporan</h3>
                                <p class="text-gray-600 mb-4">Pilih layanan pemulihan yang telah diberikan kepada pelapor. Ini akan dicatat dalam laporan akhir.</p>

                                <form action="{{ route('superadmin.laporan.selesaikan', $pengaduan) }}" method="POST">
                                    @csrf
                                    <div class="space-y-2 mb-6">
                                        @php
                                            $layananOptions = ['psikologis', 'akademis', 'administratif'];
                                        @endphp
                                        @foreach($layananOptions as $option)
                                        <label class="flex items-center p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                                            <input type="checkbox" name="layanan_pemulihan[]" value="{{ $option }}" class="form-checkbox h-5 w-5 text-orange-600">
                                            <span class="ml-3 text-gray-700 font-medium">{{ ucfirst($option) }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-end space-x-4">
                                        <button type="button" onclick="document.getElementById('modal-selesai').classList.add('hidden')" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">Batal</button>
                                        <button type="submit" class="btn-success px-4 py-2 rounded-lg">Simpan & Selesaikan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-center text-gray-600">Menunggu Pemeriksaan & Klarifikasi Petugas</p>
                        <p class="text-xm text-center text-blue-600 font-semibold">{{ $pengaduan->petugas->name }}</p>
                    @endif
                    @break

                @case('selesai')
                    <p class="text-sm text-center text-gray-600">Laporan ini telah selesai ditangani.</p>
                    <div class="text-center flex justify-center">
                        <a href="{{ route('superadmin.laporan.pdf', $pengaduan) }}" target="_blank" class="w-max flex items-center gap-1 bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                            </svg>
                            Print
                        </a>
                    </div>
                    @break

                @case('ditolak')
                    <p class="text-sm text-center text-gray-600">Laporan ini telah ditolak.</p>
                    <div class="text-center flex justify-center">
                        <a href="{{ route('superadmin.laporan.pdf', $pengaduan) }}" target="_blank" class="w-max flex items-center gap-1 bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
                            </svg>
                            Print
                        </a>
                    </div>
                    @break
            @endswitch
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordionContainer = document.getElementById('accordion-container');
    accordionContainer.addEventListener('click', function(event) {
        const header = event.target.closest('.accordion-header');
        if (!header) return;

        const content = header.nextElementSibling;
        const arrow = header.querySelector('.accordion-arrow');

        content.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    });
});
</script>
@endpush
@endsection
