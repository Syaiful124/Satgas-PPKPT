<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SATGAS PPKPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=login');

        @tailwind base;
        @tailwind components;
        @tailwind utilities;

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(20deg, #ffffff, #ff6900);
            max-width: device-width;
            max-height: device-height;
            height: 100vh;
            margin: 0;
            padding: 0;
            flex-direction: column;
        }
        .login-icon {
            display: inline-block;
            background-color: #fff;
            padding: 1rem;
            border-radius: 9999px;
            margin-bottom: 1rem;
            width: auto;
        }
        .login-icon svg {
            width: 3rem;
            height: 3rem;
            color: #ff6900;
        }
    </style>

</head>
<body class=" flex items-center justify-center w-full">
    <a href="{{ url()->previous() }}" onclick="window.history.back(); return false;" class="absolute text-1xl top-4 left-4 text-black-500 hover:text-gray-800 ml-6 mt-4 flex items-center w-auto gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        Back
    </a>
    <div class=" p-8  w-fit relative flex items-center justify-center flex-col">
        <div class="login-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-800">SATGAS PPKPT</h1>
        <p class="text-gray-600">Selamat datang kembali, silahkan login untuk melanjutkan.</p>
    </div>
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md relative">
        <div>
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
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required placeholder="email@gmail.com" value="{{ old('email') }}">
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required placeholder="password">
                        <button type="button" class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-gray-700">
                            <svg class="bi bi-eye-fill h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" clip-rule="evenodd" />
                            </svg>
                            <svg class="bi bi-eye-slash-fill h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                                <path fill-rule="evenodd" d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full bg-gray-800 text-white py-3 rounded-lg hover:bg-gray-900 transition-colors">Login</button>
            </form>
        </div>
        <div class="text-center mt-4">
            <p class="text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="text-orange-500 font-bold">Register</a></p>
        </div>
    </div>
    <div class="text-gray-600 text-sm flex justify-center m-3">
        <p>&copy; {{ date('Y') }} SATGAS PPKPT. All rights reserved.</p>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');

        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Dapatkan input password yang berada tepat sebelum tombol ini
                const passwordInput = this.previousElementSibling;

                // Dapatkan ikon mata di dalam tombol
                const eyeIcon = this.querySelector('.bi-eye-fill');
                const eyeSlashIcon = this.querySelector('.bi-eye-slash-fill');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeSlashIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeSlashIcon.classList.add('hidden');
                }
            });
        });
    });
    </script>
</body>
</html>

