<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // Menampilkan halaman Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login yang sudah disederhanakan
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Langsung arahkan berdasarkan role, tanpa verifikasi
            if ($user->role === 'superadmin') {
                return redirect()->intended(route('superadmin.dashboard'));
            } elseif ($user->role === 'admin') {
                return redirect()->intended(route('admin.laporan.masuk'));
            } else { // Ini untuk 'user'
                return redirect()->intended(route('account.index'));
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Menampilkan halaman Registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses Registrasi yang sudah disederhanakan
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        // Langsung loginkan user setelah registrasi
        Auth::login($user);

        // Arahkan ke halaman akun mereka
        return redirect()->route('account.index')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
