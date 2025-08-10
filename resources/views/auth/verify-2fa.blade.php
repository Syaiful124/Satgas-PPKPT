<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-sm text-center">
        <h1 class="text-2xl font-bold text-gray-800">Verifikasi Dua Langkah</h1>
        <p class="text-gray-500 mt-2 mb-6">Kami telah mengirimkan 5 digit kode ke email Anda. Silakan masukkan kode tersebut.</p>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('2fa.verify') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="code" class="block text-gray-700 font-bold mb-2">Kode Verifikasi</label>
                <input type="text" id="code" name="code" class="w-full text-center text-2xl tracking-[1em] px-4 py-2 border rounded-lg" required autofocus>
            </div>
            <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg hover:bg-orange-600">Verifikasi</button>
        </form>
        <a href="{{ route('login') }}" class="inline-block mt-4 text-sm text-gray-600 hover:underline">Kembali ke Halaman Login</a>
    </div>
</body>
</html>
