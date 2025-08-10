<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SATGAS PPKPT - @yield('title')</title>
    {{-- Ganti dengan link ke library CSS Anda, contoh: Bootstrap/Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles untuk mencocokkan desain */
        body { font-family: 'Poppins', sans-serif; background-color: #f7fafc; }
        .sidebar { background-color: #333; color: white; }
        .sidebar a { color: #e2e8f0; }
        .sidebar a.active { background-color: #f6993f; color: white; font-weight: bold; }
        .btn-primary { background-color: #f6993f; color: white; }
        .btn-primary:hover { background-color: #de751f; }
        .btn-danger { background-color: #e53e3e; color: white; }
        .btn-danger:hover { background-color: #c53030; }
        .btn-success { background-color: #48bb78; color: white; }
        .btn-success:hover { background-color: #38a169; }
        .badge-menunggu { background-color: #f6993f; color: white; }
        .badge-penanganan { background-color: #ecc94b; color: #4a5568; }
        .badge-selesai { background-color: #48bb78; color: white; }
        .badge-ditolak { background-color: #e53e3e; color: white; }
    </style>
</head>
<body class="flex bg-gray-100 min-h-screen">
    <aside class="w-64 sidebar p-4 flex flex-col justify-between">
        <div>
            <div class="text-center mb-10">
                <h1 class="text-2xl font-bold">SATGAS</h1>
                <p class="text-sm">Admin Panel</p>
            </div>
            <nav>
                <ul>
                    @if(auth()->user()->role == 'superadmin')
                        <li class="mb-2"><a href="{{ route('superadmin.dashboard') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                        <li class="mb-2"><a href="{{ route('superadmin.laporan.masuk') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.laporan.masuk') ? 'active' : '' }}">Laporan Masuk</a></li>
                        {{-- Tambahkan menu lainnya untuk superadmin --}}
                        <li class="mb-2"><a href="{{ route('superadmin.laporan.selesai') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.laporan.selesai') ? 'active' : '' }}">Selesai</a></li>
                        <li class="mb-2"><a href="{{ route('superadmin.laporan.ditolak') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.laporan.ditolak') ? 'active' : '' }}">Ditolak</a></li>
                        <li class="mb-2"><a href="{{ route('superadmin.users.index') }}" class="block p-2 rounded {{ request()->routeIs('superadmin.users.*') ? 'active' : '' }}">Management Account</a></li>
                    @elseif(auth()->user()->role == 'admin')
                        <li class="mb-2"><a href="{{ route('admin.laporan.masuk') }}" class="block p-2 rounded {{ request()->routeIs('admin.laporan.masuk') ? 'active' : '' }}">Laporan Masuk</a></li>
                        <li class="mb-2"><a href="{{ route('admin.users.index') }}" class="block p-2 rounded {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Management Account</a></li>
                    @endif
                </ul>
            </nav>
        </div>
        <div>
            <div class="p-4 rounded-lg bg-orange-400 text-center text-white mb-4">
                <p class="font-bold">{{ auth()->user()->role == 'superadmin' ? 'KETUA' : 'PETUGAS' }}</p>
                <p class="text-sm">{{ auth()->user()->name }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white p-2 rounded hover:bg-red-700">Logout</button>
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

</body>
</html>
