<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use App\Mail\TwoFactorCodeMail; // Mail baru untuk 2FA

class AuthController extends Controller
{
    // Halaman Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();

            // Jika User, pastikan email sudah terverifikasi
            if ($user->role === 'user') {
                if (!$user->hasVerifiedEmail()) {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Akun Anda belum diverifikasi. Silakan cek email Anda.'])->onlyInput('email');
                }
                $request->session()->regenerate();
                return redirect()->intended(route('account.index'));
            }

            // Jika Admin atau Superadmin, mulai proses 2FA
            if ($user->role === 'admin' || $user->role === 'superadmin') {
                // Generate kode 2FA
                $code = random_int(10000, 99999);

                // Simpan kode dan ID user di session untuk verifikasi nanti
                $request->session()->put([
                    '2fa_user_id' => $user->id,
                    '2fa_code' => $code,
                    '2fa_expiry' => now()->addMinutes(10),
                ]);

                // Kirim email berisi kode (gunakan try-catch untuk error handling)
                try {
                    Mail::to($user->email)->send(new TwoFactorCodeMail($code));
                } catch (\Exception $e) {
                     Auth::logout();
                     return back()->withErrors(['email' => 'Gagal mengirim kode verifikasi. Coba lagi nanti.'])->onlyInput('email');
                }

                // Logout user sementara dan arahkan ke halaman verifikasi 2FA
                Auth::logout();
                return redirect()->route('2fa.form')->with('email', $user->email);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    // Halaman verifikasi 2FA
    public function showVerifyForm()
    {
        if (!session('2fa_user_id')) {
            return redirect()->route('login');
        }
        return view('auth.verify-2fa');
    }

    // Proses verifikasi 2FA
    public function verify2fa(Request $request)
    {
        $request->validate(['code' => 'required|numeric']);

        // Cek jika sesi 2FA masih valid
        if (!session('2fa_user_id') || session('2fa_expiry') < now()) {
            return redirect()->route('login')->withErrors(['email' => 'Sesi verifikasi telah kedaluwarsa. Silakan login kembali.']);
        }

        // Cek jika kode cocok
        if ($request->code != session('2fa_code')) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid.']);
        }

        // Jika berhasil, loginkan user
        Auth::loginUsingId(session('2fa_user_id'));

        // Hapus data 2FA dari sesi
        $request->session()->forget(['2fa_user_id', '2fa_code', '2fa_expiry']);

        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->role == 'superadmin') {
            return redirect()->intended(route('superadmin.dashboard'));
        }
        return redirect()->intended(route('admin.laporan.masuk'));
    }

    // Halaman Registrasi
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses Registrasi
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
            'role' => 'user', // Role di-set otomatis menjadi 'user'
        ]);

        // Kirim email verifikasi
        $user->sendEmailVerificationNotification();

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi akun.');
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
