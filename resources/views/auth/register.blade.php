<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SATGAS PPKPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(20deg, #ffffff, #ff6900);
            height: 100vh;
            margin: 0;
            padding: 0;
            flex-direction: column;
        }
        .login-icon {
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
<body class="flex items-center justify-center w-full h-full ">
    <a href="{{ url()->previous() }}" onclick="window.history.back(); return false;" class="absolute text-1xl top-4 left-4 text-black-500 hover:text-gray-800 ml-6 mt-4 flex items-center w-auto gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
        </svg>
        Back
    </a>
    <div class="mt-10 mb-10 w-full flex items-center justify-center flex-col">
        <div class=" w-max relative flex items-center justify-center flex-col">
            <div class="login-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">REGISTER SATGAS PPKPT</h1>
            <p class="text-gray-600">Silahkan masukkan data anda untuk membuat register akun.</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-fit relative">

            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nama Lengkap*</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" required value="{{ old('name') }}" placeholder="nama lengkap">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email*</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg" required value="{{ old('email') }}" placeholder="email@gmail.com">
                </div>
                <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-gray-600 mb-6">
                    <div id="check-length" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Minimal 8 karakter</div>
                    <div id="check-uppercase" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Mengandung huruf besar</div>
                    <div id="check-number" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Mengandung angka</div>
                    <div id="check-symbol" class="flex items-center"><svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>Mengandung simbol</div>
                </div>
                <div class="flex items-center justify-center gap-8">
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password*</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg" required placeholder="password">
                            <button type="button" class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
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
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Konfirmasi Password*</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg" required placeholder="konfirmasi password">
                            <button type="button" class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-gray-500">
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
                </div>
                <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900">Register</button>
                <div class="text-center mt-4 text-sm">
                    <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-orange-500 font-bold">Login User</a></p>
                </div>
            </form>
        </div>
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

        const togglePasswordButtons = document.querySelectorAll('.toggle-password');

        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', function () {
                const passwordInput = this.previousElementSibling;

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
