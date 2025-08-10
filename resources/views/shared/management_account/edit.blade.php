@extends('layouts.app')

@section('title', 'Edit Account')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Edit Account</h1>
    <a href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.users.index', ['role' => $user->role]) : route('admin.users.index') }}" class="text-gray-600 hover:text-gray-900">&larr; BACK</a>
</div>

<div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
    <form action="{{ auth()->user()->role == 'superadmin' ? route('superadmin.users.update', $user->id) : route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Error</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Nama Lengkap*</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email*</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
        </div>

        @if(auth()->user()->role == 'superadmin')
        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-bold mb-2">Role*</label>
            <select name="role" id="role" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ old('role', $user->role) == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
            </select>
            @if($user->id === auth()->id())
                <p class="text-xs text-gray-500 mt-1">Anda tidak dapat mengubah role Anda sendiri.</p>
            @endif
        </div>
        @endif

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password Baru</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.users.index', ['role' => $user->role]) : route('admin.users.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400">Cancel</a>
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Update</button>
        </div>
    </form>
</div>
@endsection
