@extends('layouts.public')
@section('title', 'Beranda')

@section('content')
<div class="relative h-[60vh] md:h-[90vh] w-full mb-6">
    <div class="h-full w-full">
        <div class="absolute inset-0 bg-black bg-opacity-50 p-12 flex flex-col justify-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight">"Satgas PPKPT: Garda Depan Integritas Kampus STIMATA."</h1>
            <p class="text-lg mb-6">Satgas PPKPT STIMATA hadir untuk menciptakan lingkungan kampus yang aman dan bebas dari kekerasan. Jangan ragu untuk melaporkan setiap insiden yang Anda alami atau saksikan.</p>
            <div class="flex space-x-4">
                <a href="{{ route('pengaduan.create') }}" class="bg-orange-300 text-black font-bold py-3 px-6 rounded-lg hover:bg-orange-500 hover:text-white transition duration-300">Buat Laporan Sekarang</a>
                <a href="#tentang-kami" class="bg-gray-300 text-black font-bold py-3 px-6 rounded-lg hover:bg-gray-500 hover:text-white transition duration-300">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="block h-[60vh] md:h-[90vh] w-full">
            <img src="{{ asset('images/beranda.jpeg') }}" alt="Tim Satgas" class="w-full h-full object-cover">
        </div>
    </div>
</div>

<section class="p-6">
    <div class="flex flex-col mx-auto px-4 gap-6 mt-14">
        <div class="flex flex-col ">
            <h2 class="text-3xl font-bold  text-center text-gray-800 mb-2">Struktur Keanggotaan</h2>
            <p class="text-center text-gray-500">Satgas PPKS STMIK PPKIA Pradnya Paramita Malang</p>
        </div>

        {{-- KETUA --}}
        @if ($ketua)
        <div class="flex justify-center">
            <div class="w-[350px] h-[250px] flex flex-col items-center justify-center text-center bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                <img class="w-24 h-24 mx-auto rounded-full mb-4 object-cover" src="{{ asset('images/ketua.png') }}" alt="Foto Ketua">
                <h3 class="text-xl font-bold text-gray-900">{{ $ketua->name }}</h3>
                <p class="font-semibold text-orange-500">Ketua</p>
            </div>
        </div>
        @endif

        {{-- SEKRETARIS --}}
        @if ($sekretaris)
        <div class="flex justify-center">
            <div class="w-[350px] h-[250px] flex flex-col items-center justify-center text-center bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                <img class="w-24 h-24 mx-auto rounded-full mb-4 object-cover" src="{{ asset('images/sekretaris.jpg') }}" alt="Foto Sekretaris">
                <h3 class="text-xl font-bold text-gray-900">{{ $sekretaris->name }}</h3>
                <p class="font-semibold text-orange-500">Sekretaris</p>
            </div>
        </div>
        @endif

        {{-- ANGGOTA (DINAMIS) --}}
        <div class="flex flex-wrap justify-center items-center gap-8">
            @forelse ($anggotas as $anggota)
                <div class="w-[350px] h-[250px] flex flex-col items-center justify-center text-center bg-white p-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    @php
                        $nomorUrut = ['satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan'];
                        $index = $loop->index;
                        $namaUrut = $nomorUrut[$index] ?? $index + 1;
                        $extensions = ['png', 'jpg', 'jpeg'];
                        $imageUrl = null;

                        foreach ($extensions as $ext) {
                            $path = 'images/anggota_' . $namaUrut . '.' . $ext;
                            if (file_exists(public_path($path))) {
                                $imageUrl = asset($path);
                                break;
                            }
                        }

                        if (!$imageUrl) {
                            $imageUrl = 'https://ui-avatars.com/api/?name=' . urlencode($anggota->name) . '&color=FFFFFF&background=fb923c&size=128';
                        }
                    @endphp
                    <img class="w-24 h-24 mx-auto rounded-full mb-4 object-cover"
                        src="{{ $imageUrl }}"
                        alt="Foto {{ $anggota->name }}">
                    <h3 class="text-xl font-bold text-gray-900">{{ $anggota->name }}</h3>
                    <p class="font-semibold text-orange-500">Anggota</p>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-full">Data anggota belum tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- <section class="p-6">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Galeri Kegiatan Penanganan</h2>
        <p class="text-center text-gray-500 mb-6">Dokumentasi kegiatan dan hasil penanganan oleh Satgas PPKS.</p>

        @if($galeriItems->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-2 bg-gray-50 rounded-lg shadow-lg">
                @foreach ($galeriItems as $item)
                    <a href="{{ Storage::url($item->file_path) }}" data-fancybox="gallery" data-caption="Dokumentasi Laporan Selesai #{{ $item->penanganan->pengaduan->id }}" class="group relative block w-full h-64 bg-gray-900 rounded-lg overflow-hidden">

                            <video class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                                <source src="{{ Storage::url($item->file_path) }}#t=0.1" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>

                        <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-40 transition-all duration-300 flex items-center justify-center">
                            @if ($item->file_type == 'video')
                                <svg class="w-16 h-16 text-white opacity-80" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                            @else
                                <svg class="w-16 h-16 text-white opacity-0 group-hover:opacity-80 transition-opacity duration-300" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8zm8-3a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500 py-16 border-2 border-dashed rounded-lg">
                <p>Belum ada kegiatan yang dapat ditampilkan di galeri.</p>
            </div>
        @endif
    </div>
</section> --}}

<section id="alur-pengaduan" class="p-6 bg-gray-50">
    <div class=" mx-auto px-4 mt-14">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Alur Pengaduan</h2>
        <p class="text-center text-gray-500 mb-8">Langkah-langkah mudah untuk melaporkan insiden dan bagaimana kami menindaklanjutinya.</p>

        {{-- KONTENER UTAMA TIMELINE --}}
        <div id="timeline-container" class="relative">
            <div class="absolute left-1/2 top-0 h-full w-1 bg-gray-200 rounded -ml-0.5"></div>
            <div id="timeline-progress" class="absolute left-1/2 top-0 h-0 w-1 bg-orange-500 rounded -ml-0.5"></div>

            <div class="relative flex mb-12">
                <div class="w-1/2 pr-3 text-right flex">
                    <div class="p-6 bg-white rounded-lg shadow-md border-l-4 border-orange-500 flex items-end flex-col">
                        <div class="flex items-center gap-4">
                            <h3 class="text-lg font-semibold text-gray-800">Login & Akses Layanan</h3>
                            <div class="w-10 h-10 bg-orange-500 rounded-full border-4 border-white flex items-center justify-center text-center text-white font-bold"><p class="w-8 h-8 p-1">1</p></div>
                        </div>
                        <p class="text-gray-600 mt-1">Mahasiswa/dosen/tenaga kependidikan masuk melalui akun SSO (Single Sign-On) kampus. Disediakan menu khusus “Pelaporan Kekerasan Seksual (PPKPT)”. Status laporan akan tersedia di halaman profile jika pelapor sudah memiliki akun.</p>
                    </div>
                </div>
                <div class="w-1/2 pl-3 text-left flex">
                    <div class="p-6 bg-white rounded-lg shadow-md border-r-4 border-orange-500">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-orange-500 rounded-full border-4 border-white flex items-center justify-center text-center text-white font-bold z-10"><p class="w-8 h-8 p-1">2</p></div>
                            <h3 class="text-lg font-semibold text-gray-800">Pengisian Form Laporan Online</h3>
                        </div>
                        <p class="text-gray-600 mt-1">Form berisi identitas pelapor (bisa anonim/rahasia), kronologi, bukti (upload file/audio/video), serta opsi pendampingan yang diinginkan. Pelapor bisa memilih pendampingan psikologis, hukum, atau medis lewat aplikasi. Sistem memberi nomor laporan otomatis.</p>
                    </div>
                </div>
            </div>

            <div class="relative flex mb-12">
                <div class="w-1/2 pr-3 text-right flex">
                    <div class="p-6 bg-white rounded-lg shadow-md border-l-4 border-orange-500 flex items-end flex-col">
                        <div class="flex items-center gap-4">
                            <h3 class="text-lg font-semibold text-gray-800">Menunggu Verifikasi</h3>
                            <div class="w-10 h-10 bg-orange-500 rounded-full border-4 border-white flex items-center justify-center text-center text-white font-bold"><p class="w-8 h-8 p-1">3</p></div>
                        </div>
                        <p class="text-gray-600 mt-1">Ketua Satgas menerima notifikasi laporan baru. <br>Laporan diverifikasi → jika lengkap diproses, jika belum lengkap pelapor ditolak dengan alasan yang jelas.</p>
                    </div>
                </div>
                <div class="w-1/2 pl-3 text-left flex">
                    <div class="p-6 bg-white rounded-lg shadow-md border-r-4 border-orange-500">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-orange-500 rounded-full border-4 border-white flex items-center justify-center text-center text-white font-bold z-10"><p class="w-8 h-8 p-1">4</p></div>
                            <h3 class="text-lg font-semibold text-gray-800">Penanganan : Proses Klarifikasi & Pemeriksaan</h3>
                        </div>
                        <p class="text-gray-600 mt-1">Setelah Diverifikasi oleh Ketua Satgas, Ketua akan mengirimkan laporan dan surat tugas ke petugas satgas yang ditunjuk untuk melakukan pemeriksaan terdokumentasi. Dari hasil pemeriksaan, petugas satgas akan menentukan tindak lanjut, apakah perlu dilakukan sanksi, tindakan administratif, atau penerusan ke hukum (ditentukan melalui hasil penelusuran kasus).</p>
                    </div>
                </div>
            </div>

            <div class="relative flex mb-12">
                <div class="w-1/2 pr-3 text-right flex">
                    <div class="p-6 bg-white rounded-lg shadow-md border-l-4 border-orange-500 flex items-end flex-col">
                        <div class="flex items-center gap-4">
                            <h3 class="text-lg font-semibold text-gray-800">Penanganan : Ditindak Lanjuti</h3>
                            <div class="w-max h-max  bg-orange-500 rounded-full border-4 border-white flex items-center justify-center text-center text-white font-bold"><p class="w-8 h-8 p-1">5</p></div>
                        </div>
                        <p class="text-gray-600 mt-1">Tindak lanjut tersebut akan diteruskan ke ketua satgas untuk ditindaklanjuti, sesuai dengan rekomendasi dari petugas. Kemudian korban akan mendapat update layanan pemulihan (psikologis, akademik, administratif).</p>
                    </div>
                </div>
                <div class="w-1/2 pl-3 text-left flex">
                    <div class="p-6 bg-white rounded-lg shadow-md border-r-4 border-orange-500">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-orange-500 rounded-full border-4 border-white flex items-center justify-center text-center text-white font-bold z-10"><p class="w-8 h-8 p-1">6</p></div>
                            <h3 class="text-lg font-semibold text-gray-800">Laporan selesai</h3>
                        </div>
                        <p class="text-gray-600 mt-1">Setelah penindakan lanjutan telah dilaksanakan, laporan akan dianggap selesai. Monitoring implementasi sanksi terhadap pelaku dicatat dalam sistem. Sistem bisa menghasilkan rekap laporan berisi jumlah dari status ( menunggu verifikasi, penanganan (proses klarifikasi & pemeriksaan, ditindaklanjuti), ditindaklanjuti dan evaluasi → untuk evaluasi internal kampus dan laporan ke Kemendikbud.)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tentang-kami" class="flex flex-col w-full gap-8 p-6">
    <div class="text-center mt-14">
        <h2 class="text-3xl font-bold text-gray-800">Tentang Satgas PPKPT</h2>
        <p class="text-gray-500 mt-2">Mengenal Misi dan Visi</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="bg-white p-8 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
            <div class="bg-orange-100 text-orange-500 rounded-full p-4 inline-flex mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Pencegahan</h3>
            <p class="text-gray-600">Kami proaktif melakukan sosialisasi dan edukasi untuk mencegah terjadinya kekerasan seksual di lingkungan kampus.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
            <div class="bg-blue-100 text-blue-500 rounded-full p-4 inline-flex mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h6l2-2h2l-2 2z" /></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Penanganan</h3>
            <p class="text-gray-600">Memberikan pendampingan, perlindungan, dan memproses setiap laporan yang masuk dengan prinsip kerahasiaan dan berpihak pada korban.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
            <div class="bg-green-100 text-green-500 rounded-full p-4 inline-flex mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Pemulihan</h3>
            <p class="text-gray-600">Membantu korban mendapatkan dukungan psikologis dan fasilitas pemulihan lainnya untuk melewati masa sulit.</p>
        </div>
    </div>

    <div class="text-center mt-4">
        <p class="text-center text-gray-500 ">Pelajari lebih lanjut mengenai tugas, wewenang, dan kode etik.</p>
    </div>

    <div id="info-tabs">
        <div class="flex justify-center space-x-2 md:space-x-4 mb-2" role="tablist">
            <button role="tab" data-target="#tugas" class="tab-button tab-active">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/><path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/><path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/></svg>
                <span>Tugas</span>
                <div class="tab-pointer"></div>
            </button>
            <button role="tab" data-target="#wewenang" class="tab-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16"><path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.15c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"/></svg>
                <span>Wewenang</span>
                <div class="tab-pointer"></div>
            </button>
            <button role="tab" data-target="#kode-etik" class="tab-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16"><path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.016 7.016 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.015 7.015 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/><path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/></svg>
                <span>Kode Etik</span>
                <div class="tab-pointer"></div>
            </button>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border border-orange-200">
            <div id="tugas" role="tabpanel" class="tab-content">
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>Melakukan survey, sosialisasi dan edukasi berkaitan dengan pendidikan kesetaraan gender, kesetaraan disabilitas, pendidikan kesehatan seksual dan reproduksi serta pencegahan dan penanganan kekerasan bagi lingkungan STMIK PPKIA Pradnya Paramita.</li>
                    <li>Menindaklanjuti pelanggaran yang terjadi akibat kekerasan berdasarkan laporan yang diterima.</li>
                    <li>Melakukan koordinasi dengan instansi terkait didalam pemberian perlindungan korban dan saksi.</li>
                    <li>Memantau pelaksanaan rekomendasi dari satua tugas oleh pimpinan STMIK PPKIA Pradnya Paramita.</li>
                    <li>Menyampaikan laporan kegiatan Pencegahan dan Penanganan Kekerasan kepada Pimpinan minimal 1 kali dalam 6 bulan.</li>
                </ul>
            </div>
            <div id="wewenang" role="tabpanel" class="tab-content hidden">
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>Memanggil dan meminta keterangan dari para korban, saksi, terlapor, pendamping dan atau ahli.</li>
                    <li>Meminta bantuan pimpinan STMIK PPKIA Pradnya Paramita untuk menghadirkan para saksi, terlapor, pendamping, dan atau ahli dalam pemeriksaan.</li>
                    <li>Melakukan konsultasi terkait penanganan kekerasan dengan pihak terkait dengan mempertimbangkan kondisi, keamanan dan kenyamanan korban.</li>
                </ul>
            </div>
            <div id="kode-etik" role="tabpanel" class="tab-content hidden">
                <ul class="list-disc list-inside space-y-2 text-gray-700">
                    <li>Menjamin kerahasiaan identitas pihak yang terkait langsung dengan laporan.</li>
                    <li>Menjaga independensi dan kredibilitas satuan tugas.</li>
                    <li>Menjaga keamanan korban, saksi, dan atau pelapor.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<style>
    .tab-button {
        padding: 0.75rem 1.5rem;
        border: 1px solid #fb923c;
        border-radius: 0.5rem;
        color: #f97316;
        background-color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
    }
    .tab-button:hover {
        background-color: #fff7ed;
    }
    .tab-button .tab-pointer {
        display: none;
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-top: 10px solid #fb923c;
    }
    .tab-button.tab-active {
        background: linear-gradient(to right, #f97316, #fb923c);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }
    .tab-button.tab-active .tab-pointer {
        display: block;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Nonaktifkan semua tab
            tabs.forEach(item => item.classList.remove('tab-active'));

            // Aktifkan tab yang diklik
            this.classList.add('tab-active');

            // Sembunyikan semua konten
            tabContents.forEach(content => content.classList.add('hidden'));

            // Tampilkan konten yang sesuai
            const target = document.querySelector(this.dataset.target);
            if (target) {
                target.classList.remove('hidden');
            }
        });
    });

    const timeline = document.querySelector('#timeline-container');
    const progressLine = document.querySelector('#timeline-progress');

    // Fungsi untuk mengupdate animasi scroll
    const updateTimelineOnScroll = () => {
        if (!timeline || !progressLine) return;

        const timelineRect = timeline.getBoundingClientRect();
        const viewportHeight = window.innerHeight;

        // Titik tengah layar sebagai pemicu awal
        const triggerPoint = viewportHeight / 2;

        // Hitung progres HANYA setelah bagian atas timeline melewati tengah layar
        const scrollPercent = (triggerPoint - timelineRect.top) / timelineRect.height;

        // Batasi nilai antara 0 (0%) dan 1 (100%)
        const progress = Math.max(0, Math.min(1, scrollPercent));

        // Terapkan tinggi pada garis progres
        progressLine.style.height = (progress * 100) + '%';
    };

    // Panggil fungsi saat user scroll dan saat halaman dimuat
    window.addEventListener('scroll', updateTimelineOnScroll);
    updateTimelineOnScroll();
});
</script>
@endpush
