{{-- Tampilan ini bisa dibuat mirip dengan login.blade.php tapi dengan field registrasi --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SATGAS PPKPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-500 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative">
        <a href="{{ route('login') }}" class="absolute top-4 left-4 text-gray-600 hover:text-gray-900">&larr; BACK</a>
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">REGISTER</h1>
            <p class="text-gray-500">Silahkan masukkan data anda untuk membuat akun</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Nama Lengkap*</label>
                <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" required value="{{ old('name') }}">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email*</label>
                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg" required value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-bold mb-2">Password*</label>
                <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password*</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg" required>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-gray-600 mb-6">
                <div id="check-length" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Minimal 8 karakter</div>
                <div id="check-uppercase" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Mengandung huruf besar</div>
                <div id="check-number" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Mengandung angka</div>
                <div id="check-symbol" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Mengandung simbol</div>
            </div>

            <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900">Register</button>
            <div class="text-center mt-4 text-sm">
                <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-orange-500 font-bold">Login User</a></p>
            </div>
        </form>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const checks = {
            length: document.getElementById('check-length'),
            uppercase: document.getElementById('check-uppercase'),
            number: document.getElementById('check-number'),
            symbol: document.getElementById('check-symbol')
        };
        const successColor = 'text-green-500';
        const failColor = 'text-red-500';

        passwordInput.addEventListener('input', function() {
            const val = this.value;
            // Length
            updateCheck(checks.length, val.length >= 8);
            // Uppercase
            updateCheck(checks.uppercase, /[A-Z]/.test(val));
            // Number
            updateCheck(checks.number, /[0-9]/.test(val));
            // Symbol
            updateCheck(checks.symbol, /[^A-Za-z0-9]/.test(val));
        });

        function updateCheck(element, isSuccess) {
            const svg = element.querySelector('svg');
            svg.classList.remove(isSuccess ? failColor : successColor);
            svg.classList.add(isSuccess ? successColor : failColor);
        }
    });
    </script>
</body>
</html>
