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
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen w-full">
    <header class="text-black shadow-md w-full px-4 py-3">
        <nav class="mx-auto flex justify-between items-center ml-2">
            <a href="{{ route('beranda') }}" class="flex items-center space-x-2 gap-2 cursor-pointer hover:text-orange-500 z-60" alt="beranda">
                <div>
                    <img src="{{ asset('images/logo.jpg')}}" alt="STIMATA" class="w-10 object-cover">
                </div>
                <p class="font-bold text-xl w-full">
                    SATGAS PPKPT STIMATA
                </p>
            </a>
            <div id="header-menu" class=" md:sticky md:p-0 md:m-0 header fixed md:bg-transparent flex flex-col gap-2 md:flex-row md:top-0 top-20 rounded-lg right-0 p-4 items-end w-auto bg-white transform -translate-x-[-100%] md:translate-x-0 z-30 md:z-50 transition-transform duration-300 ease-in-out md:items-center">
                <a href="{{ route('beranda') }}" class=" hover:text-orange-500 px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7h1.5a.5.5 0 0 0 .374-.832l-8-8a.5.5 0 0 0-.748 0l-8 8A.5.5 0 0 0 .5 7.5H2v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                    </svg>
                    Beranda
                </a>
                <a href="{{ route('pengaduan.create') }}" class=" bg-orange-300 hover:text-orange-500 px-4 py-2 rounded-md hover:bg-orange-500 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                    </svg>
                    Buat Laporan
                </a>
                <a href="{{ route('unduhan') }}" class=" hover:text-orange-500 px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                    </svg>
                    Unduhan
                </a>
                <a href="{{ route('hubungi.kami') }}" class=" hover:text-orange-500 px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                    Hubungi Kami
                </a>
                @auth
                    <a href="{{ route('account.index') }}" class=" hover:text-orange-500 bg-blue-300 px-4 py-2 rounded-md hover:bg-blue-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        Profile</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-300 px-4 py-2 rounded-md hover:bg-red-500 hover:text-white text-sm">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-green-300 px-4 py-2 rounded-md hover:bg-green-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                        <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                        </svg>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-300 px-4 py-2 rounded-md hover:bg-blue-500 hover:text-white">
                        Daftar
                    </a>
                @endauth
            </div>
            <div class="md:hidden">
                <button id="header-button" alt="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </nav>
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

    <a id="back-to-top-button" href="#" class="hidden fixed bottom-10 right-10 z-50 bg-orange-500 text-black p-3 rounded-full shadow-lg hover:text-white hover:bg-orange-600 transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up" viewBox="0 0 16 16">
        <path d="M3.204 11h9.592L8 5.519zm-.753-.659 4.796-5.48a1 1 0 0 1 1.506 0l4.796 5.48c.566.647.106 1.659-.753 1.659H3.204a1 1 0 0 1-.753-1.659"/>
        </svg>
    </a>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    Fancybox.bind("[data-fancybox]", {
        loop: true,
    });

    const headerButton = document.getElementById('header-button');
    const profileButton = document.getElementById('profile-button');
    const header = document.getElementById('header-menu');
    const sidebar = document.getElementById('sidebar-profile');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleHeader() {
        header.classList.toggle('-translate-x-0');
        overlay.classList.toggle('hidden');
    }
    function toggleProfile() {
        sidebar?.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    headerButton.addEventListener('click', toggleHeader);
    profileButton.addEventListener('click', toggleProfile);
    overlay.addEventListener('click', toggleHeader);

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
        window.onscroll = function () {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        };

        backToTopButton.addEventListener('click', function (e) {
            e.preventDefault();
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
