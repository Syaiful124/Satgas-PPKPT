@extends('layouts.app')
@section('title', 'Management Account')

@section('content')

<div class="flex justify-between items-center mb-6 title-h">
    <h1 class="text-3xl font-bold">Management Account</h1>
    <a href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.users.create') : route('admin.users.create') }}" class="btn-primary px-4 py-2 rounded-lg">+ Add Account</a>
</div>

<div class="bg-white rounded-lg shadow-md">
    <div class="flex border-b">
        @if(auth()->user()->role == 'superadmin')
            <a href="{{ route('superadmin.users.index', ['role' => 'user']) }}" class="px-6 py-3 {{ $role == 'user' ? 'border-b-2 border-orange-500 font-bold' : 'text-gray-500' }}">User</a>
            <a href="{{ route('superadmin.users.index', ['role' => 'admin']) }}" class="px-6 py-3 {{ $role == 'admin' ? 'border-b-2 border-orange-500 font-bold' : 'text-gray-500' }}">Admin</a>
            <a href="{{ route('superadmin.users.index', ['role' => 'superadmin']) }}" class="px-6 py-3 {{ $role == 'superadmin' ? 'border-b-2 border-orange-500 font-bold' : 'text-gray-500' }}">Super Admin</a>
        @else
            <div class="px-6 py-3 border-b-2 border-orange-500 font-bold">User</div>
        @endif
    </div>

    @auth
    @if(auth()->user()->role == 'superadmin' && isset($requests) && $requests->count() > 0)
    <div class="card overflow-x-auto m-2 p-1">
        <h3 class="font-bold mt-4 mb-2 underline">Permintaan Perubahan {{ ucfirst($role) }}</h3>
        <table class="data-table border-b w-full h-full border-b-2 mb-4">
            <thead class="p-2 ">
                <tr >
                    <th class="border-r">Nama User</th>
                    <th class="border-r">Jenis Permintaan</th>
                    <th class="border-r">Data Perubahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $req)
                <tr>
                    <td class="border-r px-4 py-2 ">{{ $req->name }}</td>
                    <td class="border-r px-4 py-2">{{ $req->status_perubahan == 'pending_update' ? 'Update Akun' : 'Hapus Akun' }}</td>
                    <td class="border-r px-4 py-2">
                        @if($req->data_perubahan)
                            @foreach($req->data_perubahan as $key => $value)
                                @if($key !== 'password')
                                    <small><strong>{{ ucfirst($key) }}:</strong> {{ $value }}</small><br>
                                @else
                                    <small><strong>Password:</strong> (diubah)</small><br>
                                @endif
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2 justify-center">
                        <form action="{{ route('superadmin.users.approve', $req) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-success rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('superadmin.users.reject', $req) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn-danger rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3 class="font-bold mt-6 underline">Daftar {{ ucfirst($role) }}</h3>
    </div>
    @endif
    @endauth

    <div class="card overflow-x-auto m-2 p-1">
        <table class="data-table w-full ">
            <thead>
                <tr>
                    <th class="border-r">Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4 border-r w-full h-full">
                        <p class="font-semibold">{{ $user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    </td>
                    <td class="p-4 flex justify-center items-center gap-4 w-[150px]">
                        @if($user->status_perubahan)
                            <em>Menunggu Persetujuan</em>
                        @else
                            <a href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.users.edit', $user) : route('admin.users.edit', $user) }}" class="text-blue-500 rounded-full hover:bg-blue-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                            </a>
                            @if(auth()->id() !== $user->id)
                            <form action="{{ auth()->user()->role == 'superadmin' ? route('superadmin.users.destroy', $user) : route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center text-red-500 rounded-full hover:bg-red-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" /></svg>
                                </button>
                            </form>
                            @endif
                        @endif
                    </td>
                </tr>
                @empty
                    <tr><td class="p-4 text-center text-gray-500">Tidak ada akun.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection
