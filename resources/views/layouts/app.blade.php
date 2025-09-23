<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') - SATGAS PPKPT</title>
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg')}}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f7fafc; }
        .sidebar { background: linear-gradient(to top, #ffffff, #ff6900 60%); color: white;}
        .sidebar a { color: #000; display: flex; flex-direction: row; padding: 10px 20px;}
        .sidebar a.active { background-color: gray; color: white; font-weight: bold; }
        .sidebar svg { width: auto; height: auto; margin-right: 10px; }
        .btn-primary { background-color: #f6993f; color: white; }
        .btn-primary:hover { background-color: #de751f; }
        .btn-danger { background-color: #e53e3e; color: white; }
        .btn-danger:hover { background-color: #c53030; }
        .btn-success { background-color: #48bb78; color: white; }
        .btn-success:hover { background-color: #38a169; }
        .badge-menunggu { background-color: #ff880060; color: black; width: 180px; border: 1px solid yellow; }
        .badge-penanganan { background-color: #ffff0060; color: black; width: 180px; border: 1px solid orange; }
        .badge-selesai { background-color: #00ff0060; color: black; width: 180px; border: 1px solid green; }
        .badge-ditolak { background-color: #ff000060; color: black; width: 180px; border: 1px solid red; }
        .side-up {
            border-radius: 0 0 20px 20px;
            border-bottom: 5px solid #fff;
        }
        .side-down {
            border-radius: 20px 20px 0 0;
            border-top: 5px solid #ff6900;
        }
        .bi-person-fill {
            background-color:#ff6900;
            width: max-content;
            height: max-content;
            padding: 10px;
            border-radius: 40px;
        }
        .jml-b {
            border: 1px solid blue;
        }
        .jml-r {
            border: 1px solid red;
        }
        .jml-g {
            border: 1px solid green;
        }

        .title-h {
            border-bottom: 4px solid #ff6900;
            padding-bottom: 10px;
        }

    </style>
</head>
<body class="flex bg-gray-100 min-h-screen">
    <aside class="w-[250px] sidebar flex flex-col justify-between h-screen sticky top-0">
        <div class="w-full">
            <div class="side-up text-center text-white pt-3 pb-4 mb-4 bg-gray-500 shadow-lg flex flex-row justify-center items-center gap-2">
                <img src="{{ asset('images/logo.jpg')}}" alt="STIMATA" class=" w-10 mr-2 object-cover">
                <div>
                    <h1 class="text-2xl font-bold">SATGAS</h1>
                    <p class="text-sm">Admin Panel</p>
                </div>
            </div>
            <nav class="pr-2 pl-2 text-sm">
                <ul class="flex flex-col">
                    @if(auth()->user()->role == 'superadmin')
                        <li>
                            <a href="{{ route('superadmin.dashboard') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139q.323-.119.684-.12h5.396z"/>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.laporan.masuk') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.laporan.masuk') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-symlink" viewBox="0 0 16 16">
                                <path d="m11.798 8.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742"/>
                                <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                                </svg>
                                Laporan Masuk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.laporan.selesai') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.laporan.selesai') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-check" viewBox="0 0 16 16">
                                <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                                <path d="M15.854 10.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.707 0l-1.5-1.5a.5.5 0 0 1 .707-.708l1.146 1.147 2.646-2.647a.5.5 0 0 1 .708 0"/>
                                </svg>
                                Selesai
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.laporan.ditolak') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.laporan.ditolak') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-x" viewBox="0 0 16 16">
                                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181L15.546 8H14.54l.265-2.91A1 1 0 0 0 13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91H9v1H2.826a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31zm6.339-1.577A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139q.323-.119.684-.12h5.396z"/>
                                <path d="M11.854 10.146a.5.5 0 0 0-.707.708L12.293 12l-1.146 1.146a.5.5 0 0 0 .707.708L13 12.707l1.146 1.147a.5.5 0 0 0 .708-.708L13.707 12l1.147-1.146a.5.5 0 0 0-.707-.708L13 11.293z"/>
                                </svg>
                                Ditolak
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('superadmin.users.index') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                </svg>
                                Management Account
                            </a>
                        </li>
                    @elseif(auth()->user()->role == 'admin')
                        <li>
                            <a href="{{ route('admin.laporan.masuk') }}" class="block p-2 rounded {{ request()->routeIs('admin.laporan.masuk') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-symlink" viewBox="0 0 16 16">
                                <path d="m11.798 8.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742"/>
                                <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                                </svg>
                                Laporan Masuk
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="block p-2 rounded {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                </svg>
                                Management Account
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
        <div class="side-down p-4">
            <div class="text-black flex px-1 w-full mb-3 gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
                <div class='flex flex-col'>
                    <h3 class="font-bold text-[12px]">{{ auth()->user()->name }}</h3>
                    <p class="text-[12px]">{{ auth()->user()->role }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-500 text-black p-2 rounded-lg hover:bg-red-600 hover:text-white flex flex-row justify-center items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 p-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>
    @stack('scripts')
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
