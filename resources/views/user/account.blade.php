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
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 border rounded mt-1">
            </div>
            <div class="mb-4">
                <label for="email" class="block font-semibold">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded mt-1">
                {{-- @if(!$user->hasVerifiedEmail())
                <p class="text-xs text-red-600 mt-1">Email belum diverifikasi. <a href="{{ route('verification.send') }}" class="underline" onclick="event.preventDefault(); this.closest('form').submit();">Kirim ulang verifikasi.</a></p>
                @endif --}}
            </div>
            <hr class="my-6">
            <h3 class="font-bold mb-2">Ubah Password</h3>
            <div class="mb-4">
                <div class="mb-4">
                    <label for="current_password" class="block font-semibold">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" name="current_password" class="w-full p-2 border rounded mt-1">
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
            <div class="mb-4">
                <label for="new_password" class="block font-semibold">Password Baru</label>
                <div class="relative">
                    <input type="password" name="new_password" class="w-full p-2 border rounded mt-1">
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
                    <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded mt-1">
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
