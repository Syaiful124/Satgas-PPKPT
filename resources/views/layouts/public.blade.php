<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SATGAS PPKPT STIMATA')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-orange-500 text-white shadow-md">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ route('beranda') }}" class="font-bold text-xl">
                SATGAS PPKPT STIMATA
            </a>
            <div class="hidden md:flex items-center space-x-4">
                <a href="{{ route('pengaduan.create') }}" class="bi bi-send hover:text-orange-200"><i class="bi bi-send w-5 text-center"></i>Kirim Pengaduan</a>
                <a href="{{ route('unduhan') }}" class="bi bi-download hover:text-orange-200"><i class="bi bi-download w-5 text-center"></i>Unduhan</a>
                <a href="{{ route('hubungi.kami') }}" class="bi bi-envelope hover:text-orange-200"><i class="bi bi-envelope w-5 text-center"></i>Hubungi Kami</a>
                @auth
                    <a href="{{ route('account.index') }}" class="bi bi-person hover:text-orange-200"><i class="bi bi-person w-5 text-center"></i>Account</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-white text-orange-500 px-4 py-2 rounded-md hover:bg-gray-200"><i class="bi bi-box-arrow-in-right w-5 text-center"></i>Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-500 px-4 py-2 rounded-md hover:bg-blue-600"><i class="bi bi-person-plus w-5 text-center"></i>Register</a>
                @endauth
            </div>
            <div class="md:hidden">
                <button id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </nav>
         <div id="mobile-menu" class="hidden md:hidden px-6 pt-2 pb-4 space-y-2">
             <a href="{{ route('pengaduan.create') }}" class="block hover:text-orange-200"><i class="bi bi-send w-5 text-center"></i>Kirim Pengaduan</a>
             <a href="{{ route('unduhan') }}" class="block hover:text-orange-200"><i class="bi bi-download w-5 text-center"></i>Unduhan</a>
             <a href="{{ route('hubungi.kami') }}" class="block hover:text-orange-200"><i class="bi bi-envelope w-5 text-center"></i>Hubungi Kami</a>
             <hr class="my-2 border-orange-400">
             @auth
                <a href="{{ route('account.index') }}" class="block hover:text-orange-200"><i class="bi bi-person w-5 text-center"></i>Account</a>
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit" class="w-full text-left">Logout</button></form>
             @else
                <a href="{{ route('login') }}" class="block hover:text-orange-200"><i class="bi bi-box-arrow-in-right w-5 text-center"></i>Login</a>
                <a href="{{ route('register') }}" class="block hover:text-orange-200"><i class="bi bi-person-plus w-5 text-center"></i>Register</a>
             @endauth
        </div>
    </header>

    <main class="container mx-auto p-6">
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('success') }}</p>
        </div>
        @endif
        @if(session('error'))
         <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p>{{ session('error') }}</p>
        </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} Satgas PPKPT STMIK PPKIA Pradnya Paramita Malang</p>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        @stack('scripts')
    </script>

</body>
</html>
