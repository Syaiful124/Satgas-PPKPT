@extends('layouts.public')
@section('title', 'Selamat Datang')

@section('content')
<div class="bg-white rounded-lg shadow-xl overflow-hidden mb-12">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-12 flex flex-col justify-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">Lapor Aman, Kami Siap Bertindak.</h1>
            <p class="text-gray-600 text-lg mb-6">Satgas PPKPT STIMATA hadir untuk menciptakan lingkungan kampus yang aman dan bebas dari kekerasan. Jangan ragu untuk melaporkan setiap insiden yang Anda alami atau saksikan.</p>
            <div class="flex space-x-4">
                <a href="{{ route('pengaduan.create') }}" class="bg-orange-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-orange-600 transition duration-300">Buat Laporan Sekarang</a>
                <a href="#tentang-kami" class="bg-gray-200 text-gray-800 font-bold py-3 px-6 rounded-lg hover:bg-gray-300 transition duration-300">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div class="hidden md:block">
            <img src="https://scontent.fsub6-6.fna.fbcdn.net/v/t39.30808-6/481274767_1177387491054707_3775528880299657301_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=a0CfO9ESh-wQ7kNvwE4JO4k&_nc_oc=AdnkFvhiZ7HOWmb3omAnEvPo3FwI_oPyoVZK3688k-6dNbEUm0bOzmAOm-DpCiVGJBc&_nc_zt=23&_nc_ht=scontent.fsub6-6.fna&_nc_gid=zWY2ExHEkGnOb_u8JIDSwQ&oh=00_AfUcpV9Y_6D2EhWhPjUn6sHJSLgvCQ74mzZ7TrmVI-HpWg&oe=68AAE629" alt="Tim Satgas" class="w-full h-full object-cover">
        </div>
    </div>
</div>

<section id="tentang-kami" class="py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-800">Tentang Satgas PPKPT</h2>
        <p class="text-gray-500 mt-2">Mengenal Misi dan Visi Kami</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="bg-orange-100 text-orange-500 rounded-full p-4 inline-flex mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Pencegahan</h3>
            <p class="text-gray-600">Kami proaktif melakukan sosialisasi dan edukasi untuk mencegah terjadinya kekerasan seksual di lingkungan kampus.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md">
             <div class="bg-blue-100 text-blue-500 rounded-full p-4 inline-flex mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2V7a2 2 0 012-2h6l2-2h2l-2 2z" /></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Penanganan</h3>
            <p class="text-gray-600">Memberikan pendampingan, perlindungan, dan memproses setiap laporan yang masuk dengan prinsip kerahasiaan dan berpihak pada korban.</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md">
            <div class="bg-green-100 text-green-500 rounded-full p-4 inline-flex mb-4">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Pemulihan</h3>
            <p class="text-gray-600">Membantu korban mendapatkan dukungan psikologis dan fasilitas pemulihan lainnya untuk melewati masa sulit.</p>
        </div>
    </div>
</section>
@endsection
