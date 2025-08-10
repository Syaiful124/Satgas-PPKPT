<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SATGAS PPKPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md relative">
        <a href="{{ route('beranda') }}" class="absolute top-4 left-4 text-gray-500 hover:text-gray-800">&larr; Beranda</a>
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">LOGIN</h1>
            <p class="text-gray-500">Selamat datang kembali</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required value="{{ old('email') }}">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <button type="submit" class="w-full bg-gray-800 text-white py-3 rounded-lg hover:bg-gray-900 transition-colors">Login</button>
        </form>
        <div class="text-center mt-4">
            <p class="text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="text-orange-500 font-bold">Register</a></p>
        </div>
    </div>
</body>
</html>
