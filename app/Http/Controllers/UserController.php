<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // === UNTUK SUPERADMIN ===

    public function index(Request $request)
    {
        $role = $request->query('role', 'user'); // Default tab is 'user'
        if (!in_array($role, ['user', 'admin', 'superadmin'])) {
            $role = 'user';
        }

        $users = User::where('role', $role)->paginate(10);

        return view('shared.management_account.index', compact('users', 'role'));
    }

    public function create()
    {
        return view('shared.management_account.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in(['user', 'admin', 'superadmin'])],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.users.index', ['role' => $request->role])->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('shared.management_account.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => ['required', Rule::in(['user', 'admin', 'superadmin'])],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);


        $data = $request->only('name', 'email', 'role');
        if($request->filled('password')){
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return redirect()->route('superadmin.users.index', ['role' => $user->role])
        ->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Mencegah superadmin menghapus dirinya sendiri
        if($user->id === Auth::id()){
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }
        $role = $user->role;
        $user->delete();
        return redirect()->route('superadmin.users.index', ['role' => $role])->with('success', 'Akun berhasil dihapus.');
    }

    // === UNTUK ADMIN (HANYA MENGELOLA USER) ===

    public function indexAdmin()
    {
        $users = User::where('role', 'user')->paginate(10);
        // Menggunakan view yang sama, tapi role dikunci
        return view('shared.management_account.index', ['users' => $users, 'role' => 'user']);
    }

    public function createUser()
    {
        return view('shared.management_account.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Role di-set otomatis
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun user berhasil ditambahkan.');
    }

     public function editUser(User $user)
    {
        if($user->role !== 'user') abort(403);
        return view('shared.management_account.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        if($user->role !== 'user') abort(403);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Akun user berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        if($user->role !== 'user') abort(403);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun user berhasil dihapus.');
    }

}
