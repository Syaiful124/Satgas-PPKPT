@extends('layouts.public')
@section('title', 'Verifikasi Email Anda')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto text-center">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Verifikasi Alamat Email Anda</h1>

    @if (session('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <p class="text-gray-600 mb-4">
        Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi. Jika Anda tidak menerima email, klik tombol di bawah untuk mengirim ulang.
    </p>

    <form class="inline-block" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="bg-orange-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600">
            Kirim Ulang Email Verifikasi
        </button>
    </form>
</div>
@endsection
