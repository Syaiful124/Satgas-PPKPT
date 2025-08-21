@extends('layouts.public')
@section('title', 'Akun Saya')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-md h-fit">
        <h2 class="text-2xl font-bold mb-4">Profil Akun</h2>
        <form action="{{ route('account.profile.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-semibold">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1">
            </div>
            <div class="mb-4">
                <label for="email" class="block font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1">
            </div>
            <hr class="my-6">
            <h3 class="font-bold mb-2">Ubah Password</h3>
            <div class="mb-4">
                <div class="mb-4">
                    <label for="current_password" class="block font-semibold">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" name="current_password" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1">
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
                    @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm text-gray-600 mb-4">
                <div id="check-length" class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    Minimal 8 karakter
                </div>
                <div id="check-uppercase" class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414-1.414L9 8.586 7.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    Huruf besar
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

            <div class="mb-4">
                <label for="new_password" class="block font-semibold">Password Baru</label>
                <div class="relative">
                    <input id="new_password" type="password" name="new_password" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1">
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
                <label for="new_password_confirmation" class="block font-semibold">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input id="new_password_confirmation" type="password" name="new_password_confirmation" class="bg-gray-200 shadow-lg w-full p-2 border rounded-lg mt-1">
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
            <div class="flex justify-end space-x-2 mt-4">
                <button type="reset" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">Reset</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Simpan</button>
            </div>
        </form>
    </div>

    <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Riwayat Pengaduan Saya</h2>
        <div class="bg-gray-50 p-4 rounded-lg mb-4 border">
            <form action="{{ route('account.index') }}" method="GET" class="flex items-center mb-4">
                <input type="text" name="search" placeholder="Cari judul laporan..." value="{{ request('search') }}" class="flex-grow p-2 border rounded-l-lg">
                <button type="submit" class="bg-gray-700 text-white p-2 rounded-r-lg hover:bg-gray-800">Cari</button>
            </form>
            <form action="{{ route('account.index') }}" method="GET">
                <div class="flex items-end space-x-4">
                    <div class="flex-grow">
                        <label class="text-sm">Status</label>
                        <select name="status" class="w-full p-2 border rounded-lg">
                            <option value="">Semua Status</option>
                            <option value="menunggu" @if(request('status') == 'menunggu') selected @endif>Menunggu</option>
                            <option value="penanganan" @if(request('status') == 'penanganan') selected @endif>Penanganan</option>
                            <option value="selesai" @if(request('status') == 'selesai') selected @endif>Selesai</option>
                            <option value="ditolak" @if(request('status') == 'ditolak') selected @endif>Ditolak</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">Urutkan</label>
                        <select name="sort" class="w-full p-2 border rounded-lg">
                            <option value="created_at_desc" @if(request('sort') == 'created_at_desc') selected @endif>Tanggal Terbaru</option>
                            <option value="created_at_asc" @if(request('sort') == 'created_at_asc') selected @endif>Tanggal Terlama</option>
                        </select>
                    </div class="flex space-x-2">
                    <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600">Filter</button>
                     <a href="{{ route('account.index') }}" class="bg-gray-300 px-4 py-2 rounded-lg">Reset</a>
                </div>
            </form>
        </div>

        <div class="space-y-3">
            @forelse ($pengaduans as $pengaduan)
                <a href="{{ route('account.pengaduan.show', $pengaduan) }}" class="block p-4 rounded-lg border hover:shadow-lg transition-shadow duration-200
                    @if($pengaduan->status == 'menunggu') bg-yellow-50 border-yellow-200 @endif
                    @if($pengaduan->status == 'penanganan') bg-blue-50 border-blue-200 @endif
                    @if($pengaduan->status == 'selesai') bg-green-50 border-green-200 @endif
                    @if($pengaduan->status == 'ditolak') bg-red-50 border-red-200 @endif
                ">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold">{{ $pengaduan->judul }}</p>
                            <p class="text-sm text-gray-500">{{ $pengaduan->kategori->nama_kategori }} | {{ $pengaduan->created_at->format('d M Y') }}</p>
                        </div>
                        <span class="text-sm font-semibold px-3 py-1 rounded-full
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
        // Cek Panjang
        updateCheck(checks.length, val.length >= 8);
        // Cek Huruf Besar
        updateCheck(checks.uppercase, /[A-Z]/.test(val));
        // Cek Angka
        updateCheck(checks.number, /[0-9]/.test(val));
        // Cek Simbol
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
