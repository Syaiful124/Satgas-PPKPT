@extends('layouts.public')
@section('title', 'Akun Saya')

@section('content')
<div class="flex p-4 gap-8">
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden md:hidden"></div>
    <div id="sidebar-profile" class="fixed w-full md:w-[500px] bg-white p-6 rounded-lg shadow-md md:sticky top-20 left-0 transform -translate-x-full md:translate-x-0 z-30 transition-transform duration-300 ease-in-out shadow-lg border-lg">
        <h2 class="text-2xl font-bold mb-4">Profil Akun</h2>
        <form action="{{ route('account.profile.update') }}" method="POST" class="flex flex-wrap md:flex-col gap-4">
            @csrf
            <div class="flex md:flex-col w-full gap-4">
                <div class="w-1/2 md:w-full">
                    <label for="name" class="block font-semibold">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1 hover:bg-white focus:bg-white focus:outline-none">
                </div>
                <div class="w-1/2 md:w-full">
                    <label for="email" class="block font-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1 hover:bg-white focus:bg-white focus:outline-none">
                </div>
            </div>
            <div class="w-full mt-4">
                <label for="current_password" class="block font-semibold">Password Saat Ini</label>
                <div class="relative">
                    <input type="password" name="current_password" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1 hover:bg-white focus:bg-white focus:outline-none">
                    <button type="button" class="toggle-password absolute inset-y-0 right-0 m-4 text-gray-500">
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
                @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="w-full">
                <label for="new_password" class="block font-semibold">Password Baru</label>
                <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-gray-600">
                    <div id="check-length" class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Minimal 8 karakter
                    </div>
                    <div id="check-uppercase" class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Huruf besar & kecil
                    </div>
                    <div id="check-number" class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Angka
                    </div>
                    <div id="check-symbol" class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Simbol
                    </div>
                </div>
                <div class="relative">
                    <input id="new_password" type="password" name="new_password" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1 items-center hover:bg-white focus:bg-white focus:outline-none">
                    <button type="button" class="toggle-password absolute inset-y-0 right-0 m-4 text-gray-500">
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

            <div class="w-full">
                <label for="new_password_confirmation" class="block font-semibold">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1 hover:bg-white focus:bg-white focus:outline-none">
                    <button type="button" class="toggle-password absolute inset-y-0 right-0 m-4 text-gray-500">
                        <svg class="bi bi-eye-fill h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" clip-rule="evenodd" />
                        </svg>
                        <svg class="bi bi-eye-slash-fill h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                            <path fill-rule="evenodd" d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    @error('new_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <p class="text-gray-500 text-sm mt-2">* Anda bisa mengubah nama lengkap, email dan password disini.<br>* Tekan tombol reset untuk mengembalikan ke akun awal(mengembalikan perubahan).</p>
            <div class="flex justify-end space-x-2 mt-4">
                <button type="reset" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-500 hover:text-white">Reset</button>
                <button type="submit" class="bg-green-300 px-4 py-2 rounded-lg hover:bg-green-500 hover:text-white">Simpan</button>
            </div>
        </form>
    </div>

    <button id="profile-button" alt="Profile" class="md:hidden fixed top-35 right-4 bg-blue-300 hover:bg-blue-500 hover:text-white m-0 p-4 rounded-full shadow-lg z-40">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
        </svg>
    </button>

    <div class="w-full bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Riwayat Pengaduan Saya</h2>
        <div class="bg-gray-50 p-4 rounded-lg mb-4 border">
            <form action="{{ route('account.index') }}" method="GET" class="flex items-center mb-4">
                <input type="text" name="search" placeholder="Cari Pengaduan" value="{{ request('search') }}" class="flex-grow p-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
                <button type="submit" class="bg-gray-700 text-white p-2 rounded-r-lg hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </form>
            <form action="{{ route('account.index') }}" method="GET">
                <div class="flex flex-wrap gap-3 items-start">
                    <div class="flex gap-3">
                        <select name="status" class="w-fit p-2 border rounded-lg cursor-pointer">
                            <option value="">Semua Status</option>
                            <option value="menunggu" @if(request('status') == 'menunggu') selected @endif>Menunggu</option>
                            <option value="penanganan" @if(request('status') == 'penanganan') selected @endif>Penanganan</option>
                            <option value="selesai" @if(request('status') == 'selesai') selected @endif>Selesai</option>
                            <option value="ditolak" @if(request('status') == 'ditolak') selected @endif>Ditolak</option>
                        </select>
                    </div>
                    <div>
                        <select name="sort" class="w-fit p-2 border rounded-lg cursor-pointer">
                            <option value="created_at_desc" @if(request('sort') == 'created_at_desc') selected @endif>Tanggal Terbaru</option>
                            <option value="created_at_asc" @if(request('sort') == 'created_at_asc') selected @endif>Tanggal Terlama</option>
                        </select>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <a href="{{ route('superadmin.dashboard') }}" class="w-full block text-center bg-gray-300 p-2 rounded-lg hover:bg-gray-500 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </a>
                    </div>
                    <div class="col-span-2 md:col-span-1 items-center ">
                        <button type="submit" class="w-full bg-orange-300 p-2 rounded-lg hover:bg-orange-500 hover:text-white flex justify-center items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="m-2">
            <p class="text-sm text-gray-600">* Klik pada pengaduan untuk melihat detailnya.</p>
            <p class="text-sm text-gray-600">* Cek status pengaduan anda setiap 1x24 jam, jika masih belum ada tindakan hubungi admin.</p>
        </div>
        <div class="space-y-3">
            @forelse ($pengaduans as $pengaduan)
                <a href="{{ route('account.pengaduan.show', $pengaduan) }}" class="block p-4 rounded-lg border hover:shadow-lg transition-shadow duration-200
                    @if($pengaduan->status == 'menunggu') bg-yellow-50 border-yellow-200 @endif
                    @if($pengaduan->status == 'penanganan') bg-blue-50 border-blue-200 @endif
                    @if($pengaduan->status == 'selesai') bg-green-50 border-green-200 @endif
                    @if($pengaduan->status == 'ditolak') bg-red-50 border-red-200 @endif
                ">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-bold">{{ $pengaduan->judul }}</p>
                            <p class="text-sm text-gray-500">{{ $pengaduan->kategori->nama_kategori }} | {{ $pengaduan->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                        <span class="text-sm font-semibold px-3 py-1 rounded-full items-center
                            @if($pengaduan->status == 'menunggu') bg-yellow-200 text-yellow-800 @endif
                            @if($pengaduan->status == 'penanganan') bg-blue-200 text-blue-800 @endif
                            @if($pengaduan->status == 'selesai') bg-green-200 text-green-800 @endif
                            @if($pengaduan->status == 'ditolak') bg-red-200 text-red-800 @endif
                        ">{{ ucfirst($pengaduan->status) }}</span>
                    </div>
                </a>
            @empty
                <div class="text-center text-gray-500 p-8 border-2 border-dashed rounded-lg">
                    <p>Anda belum pernah membuat pengaduan.</p>
                    <a href="{{ route('pengaduan.create') }}" class="mt-2 inline-block text-orange-500 font-bold">Kirim Pengaduan Sekarang</a>
                </div>
            @endforelse
        </div>
        <div class="mt-4">{{ $pengaduans->links() }}</div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('new_password_confirmation');

    function validatePasswordConfirmation() {
        const errorMessage = confirmPasswordInput.parentElement.querySelector('.text-red-500');

        if (newPasswordInput.value && confirmPasswordInput.value) {
            if (newPasswordInput.value !== confirmPasswordInput.value) {
                if (!errorMessage) {
                    let newError = document.createElement('p');
                    newError.className = 'text-red-500 text-xs mt-1';
                    newError.textContent = 'Konfirmasi password tidak cocok.';
                    confirmPasswordInput.parentElement.appendChild(newError);
                }
            } else {
                if (errorMessage) {
                    errorMessage.remove();
                }
            }
        } else {
            if (errorMessage) {
                errorMessage.remove();
            }
        }
    }

    if (newPasswordInput && confirmPasswordInput) {
        newPasswordInput.addEventListener('input', validatePasswordConfirmation);
        confirmPasswordInput.addEventListener('input', validatePasswordConfirmation);
    }

    if (!newPasswordInput) return;

    const checks = {
        length: document.getElementById('check-length'),
        uppercase: document.getElementById('check-uppercase'),
        number: document.getElementById('check-number'),
        symbol: document.getElementById('check-symbol')
    };
    const successColor = 'text-green-500';
    const failColor = 'text-red-500';

    newPasswordInput.addEventListener('input', function() {
        const val = this.value;
        updateCheck(checks.length, val.length >= 8);
        updateCheck(checks.uppercase, /[A-Z]/.test(val));
        updateCheck(checks.number, /[0-9]/.test(val));
        updateCheck(checks.symbol, /[^A-Za-z0-9]/.test(val));
    });

    function updateCheck(element, isSuccess) {
        if (!element) return;
        const svg = element.querySelector('svg');
        svg.classList.remove(isSuccess ? failColor : successColor);
        svg.classList.add(isSuccess ? successColor : failColor);
    }
});
</script>
@endpush
