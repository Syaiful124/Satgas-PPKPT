<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Menyimpan URL sebelumnya untuk tombol "Back"
        session(['previous_url' => URL::previous()]);
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role == 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin.laporan.masuk');
            }
            // Tambahkan redirect untuk role 'user' jika ada halaman dashboardnya
            // else {
            //     return redirect()->route('user.dashboard');
            // }

            // Fallback
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
