@extends('layouts.public')
@section('title', 'Hubungi Kami')

@section('content')
<section id="hubungi-kami" class="p-8">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Hubungi Kami</h1>
        <p class="text-gray-500">Kami siap membantu. Hubungi kami melalui detail di bawah ini.</p>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
        <div class="bg-white p-8 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
            <div class="bg-orange-100 text-orange-500 rounded-full p-4 inline-flex mb-4">
                <svg width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold">Alamat</h3>
            <p class="text-gray-600">Jl. Laksda Adi Sucipto No.249a, Pandanwangi, Kec. Blimbing, Kota Malang, Jawa Timur 65126</p>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
            <div class="bg-blue-100 text-blue-500 rounded-full p-4 inline-flex mb-4">
                <svg width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold">Email</h3>
                <a href="mailto:satgasppkpt@stimata.ac.id" class="text-gray-600 hover:text-orange-500 hover:underline">
                    satgas-ppkpt@stimata.ac.id
                </a>
            </div>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
            <div class="bg-green-100 text-green-500 rounded-full p-4 inline-flex mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold">Whatsapp</h3>
                <a href="https://wa.me/628777574815" target="_blank" rel="noopener noreferrer" class="text-gray-600 hover:text-orange-500 hover:underline">
                    +62 877-7574-4815
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
