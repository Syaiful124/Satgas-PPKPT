<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SATGAS PPKPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-500 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative">
        <a href="{{ session('previous_url') ?? url('/') }}" class="absolute top-4 left-4 text-gray-600 hover:text-gray-900">&larr; BACK</a>

        <div class="text-center mb-8">
            <div class="inline-block bg-orange-500 p-4 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold">ADMIN SATGAS PPKPT</h1>
            <p class="text-gray-500">Silahkan login untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email*</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required value="{{ old('email') }}">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password*</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
            </div>
            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition-colors">Login</button>
        </form>
        <div class="text-center mt-4">
            <p class="text-gray-600">Saya Bukan Admin? <a href="#" class="text-orange-500 font-bold">Login sebagai User</a></p>
        </div>
        <div class="text-center mt-8 text-gray-400 text-sm">
            @ 2025 Satgas PPKPT STMIK PPKIA Pradnya Paramita Malang
        </div>
    </div>
</body>
</html>
