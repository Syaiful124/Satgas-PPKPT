@extends('layouts.app')

@section('title', 'Add Account')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Add New Account</h1>
    <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-900">&larr; BACK</a>
</div>

<div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">
    <form action="{{ auth()->user()->role == 'superadmin' ? route('superadmin.users.store') : route('admin.users.store') }}" method="POST">
        @csrf

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
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold mb-2">Email*</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
        </div>

        @if(auth()->user()->role == 'superadmin')
        <div class="mb-4">
            <label for="role" class="block text-gray-700 font-bold mb-2">Role*</label>
            <select name="role" id="role" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>
        @endif

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">Password*</label>
            <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password*</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ url()->previous() }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400">Cancel</a>
            <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">Save</button>
        </div>
    </form>
</div>
@endsection
