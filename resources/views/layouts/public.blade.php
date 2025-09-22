<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') - SATGAS PPKPT</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg')}}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif;}
        header {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: white;
            padding: 0;
            margin: 0;
        }
        header a {
            display: flex;
            flex-direction: row;
            width: fit-content;
            height: fit-content;
            font-size: 12px;
        }
        header svg {
            margin-right: 0.5rem;
            width: auto;
            height: auto;
        }
        .mobile-menu {
            background: #ff6900;
        }

    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="text-black shadow-md w-full px-4 py-3">
        <nav class="mx-auto flex justify-between items-center ml-2">
            <div class="flex items-center space-x-2 gap-2">
                <a href="{{ route('beranda') }}">
                    <img src="{{ asset('images/logo.jpg')}}" alt="STIMATA" class="w-10 object-cover">
                </a>
                <a href="{{ route('beranda') }}" class=" font-bold text-xl w-auto items-center hover:text-orange-500 ">
                    SATGAS PPKPT STIMATA
                </a>
            </div>
            <div class="hidden md:flex items-center space-x-4 w-auto">
                <a href="{{ route('pengaduan.create') }}" class="w-[160px] bg-orange-300 hover:text-orange-500 px-4 py-2 rounded-md hover:bg-orange-500 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                    </svg>
                    Kirim Pengaduan
                </a>
                <a href="{{ route('unduhan') }}" class="w-[80px] hover:text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                    </svg>
                    Unduhan
                </a>
                <a href="{{ route('hubungi.kami') }}" class="w-[110px] hover:text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                    Hubungi Kami
                </a>
                @auth
                    <a href="{{ route('account.index') }}" class="w-[80px] hover:text-orange-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
                            Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-green-300 text-black px-4 py-2 rounded-md hover:bg-green-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-300 px-4 py-2 rounded-md hover:bg-blue-500 hover:text-white">
                        Register</a>
                @endauth
            </div>
            <div class="md:hidden">
                <button id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </nav>
        <div id="mobile-menu" class="mobile-menu hidden md:hidden absolute top-10 right-0 px-6 pt-2 pb-4 space-y-2 w-auto rounded-lg shadow-lg text-right">
            <a href="{{ route('pengaduan.create') }}" class="bg-gray-600 hover:text-orange-200 px-2 py-1 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                </svg>
                Kirim Pengaduan
            </a>
            <a href="{{ route('unduhan') }}" class="hover:text-orange-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                </svg>
                Unduhan
            </a>
            <a href="{{ route('hubungi.kami') }}" class="hover:text-orange-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                </svg>
                Hubungi Kami
            </a>
            @auth
                <a href="{{ route('account.index') }}" class="hover:text-orange-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                    Hi, name
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-2 py-1 rounded-md hover:bg-red-600">
                        Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-white text-orange-500 px-2 py-1 rounded-md hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-blue-500 px-2 py-1 rounded-md hover:bg-blue-600">
                    Register</a>
            @endauth
        </div>
    </header>

    <main class="mx-auto w-full h-full flex-grow">
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

    <footer class="bottom-0 bg-gray-800 text-white text-center py-4 mt-8">
        <p>Copyright &copy; {{ date('Y') }} Satgas PPKPT STMIK PPKIA Pradnya Paramita Malang</p>
    </footer>

    <a id="back-to-top-button" href="#" class="hidden fixed bottom-10 right-10 z-50 bg-orange-500 text-white p-3 rounded-full shadow-lg hover:bg-orange-600 transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16">
        <path d="M3.204 11h9.592L8 5.519zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659"/>
        </svg>
    </a>

@stack('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<script>
    // Inisialisasi Fancybox
    Fancybox.bind("[data-fancybox]", {
        // Opsi custom jika diperlukan
    });

    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    document.addEventListener('DOMContentLoaded', function () {
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

        const backToTopButton = document.getElementById('back-to-top-button');

        if (backToTopButton) {
            // Tampilkan tombol saat user scroll ke bawah sejauh 200px
            window.onscroll = function () {
                if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                    backToTopButton.classList.remove('hidden');
                } else {
                    backToTopButton.classList.add('hidden');
                }
            };

            // Scroll ke atas dengan halus saat tombol diklik
            backToTopButton.addEventListener('click', function (e) {
                e.preventDefault(); // Mencegah link default
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

    });

</script>
</body>
</html>
