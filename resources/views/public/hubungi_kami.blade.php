@extends('layouts.public')
@section('title', 'Hubungi Kami')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-bold text-gray-800">Hubungi Kami</h1>
        <p class="text-gray-500">Kami siap membantu. Hubungi kami melalui detail di bawah ini.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div>
            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="bg-orange-100 text-orange-500 rounded-full p-3"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg></div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Alamat</h3>
                        <p class="text-gray-600">Jl. Laksda Adi Sucipto No.249a, Pandanwangi, Kec. Blimbing, Kota Malang, Jawa Timur 65126</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-orange-100 text-orange-500 rounded-full p-3"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg></div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Email</h3>
                        <p class="text-gray-600">satgas.ppkpt@stimata.ac.id</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="bg-orange-100 text-orange-500 rounded-full p-3"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Telepon</h3>
                        <p class="text-gray-600">Telp. 0341-412699</p>
                        <p class="text-gray-600">Fax.0341-412782 </p>
                        <p class="text-gray-600">Whatsapp. 087730003828</p>
                    </div>
                </div>
            </div>
            {{-- <div class="mt-8 rounded-lg overflow-hidden shadow-lg">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.625345719323!2d112.6179391750064!3d-7.933890992087547!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7882772cd2123d%3A0x6a267926b1f7a077!2sSTMIK%20Pradnya%20Paramita!5e0!3m2!1sen!2sid!4v1723297893121!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> --}}
        </div>
        {{-- <div>
            <h3 class="text-2xl font-bold mb-4">Kirim Pesan</h3>
            <form action="#" method="POST">
                <div class="mb-4"><input type="text" placeholder="Nama Anda" class="w-full p-3 border rounded-lg"></div>
                <div class="mb-4"><input type="email" placeholder="Email Anda" class="w-full p-3 border rounded-lg"></div>
                <div class="mb-4"><textarea placeholder="Pesan Anda" rows="6" class="w-full p-3 border rounded-lg"></textarea></div>
                <button type="submit" class="w-full bg-gray-800 text-white py-3 rounded-lg hover:bg-gray-900">Kirim</button>
            </form>
        </div> --}}
    </div>
</div>
@endsection
