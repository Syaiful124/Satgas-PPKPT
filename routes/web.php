<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import Controller yang baru dan yang dimodifikasi
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PenangananController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Halaman Publik (Guest & User)
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/kirim-pengaduan', [PengaduanController::class, 'createPublic'])->name('pengaduan.create');
Route::post('/kirim-pengaduan', [PengaduanController::class, 'storePublic'])->name('pengaduan.store');
Route::get('/unduhan', [PageController::class, 'unduhan'])->name('unduhan');
Route::get('/hubungi-kami', [PageController::class, 'hubungiKami'])->name('hubungi.kami');


/*
|--------------------------------------------------------------------------
| Autentikasi (Login & Register)
|--------------------------------------------------------------------------
*/
// Form Login (digunakan bersama)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// // Form & Proses Verifikasi 2FA untuk Admin
// Route::get('/verify-2fa', [AuthController::class, 'showVerifyForm'])->name('2fa.form');
// Route::post('/verify-2fa', [AuthController::class, 'verify2fa'])->name('2fa.verify');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Form & Proses Registrasi User
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// // Proses Verifikasi Email untuk User
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect()->route('account.index')->with('success', 'Email berhasil diverifikasi!');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return back()->with('message', 'Link verifikasi baru telah dikirim!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/*
|--------------------------------------------------------------------------
| Halaman Khusus User (Setelah Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'role:user'])->prefix('account')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::post('/update-profile', [AccountController::class, 'updateProfile'])->name('profile.update');

    // CRUD Pengaduan oleh User
    Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'showUser'])->name('pengaduan.show');
    Route::get('/pengaduan/{pengaduan}/edit', [PengaduanController::class, 'editUser'])->name('pengaduan.edit');
    Route::put('/pengaduan/{pengaduan}', [PengaduanController::class, 'updateUser'])->name('pengaduan.update');
    Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroyUser'])->name('pengaduan.destroy');
});


/*
|--------------------------------------------------------------------------
| Halaman Admin & Superadmin (dari sebelumnya)
|--------------------------------------------------------------------------
*/
// --- GRUP UNTUK SUPERADMIN ---
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('laporan-masuk', [PengaduanController::class, 'laporanMasukSuperAdmin'])->name('laporan.masuk');
    Route::get('laporan-selesai', [PengaduanController::class, 'laporanSelesai'])->name('laporan.selesai');
    Route::get('laporan-ditolak', [PengaduanController::class, 'laporanDitolak'])->name('laporan.ditolak');
    Route::get('laporan/{pengaduan}', [PengaduanController::class, 'show'])->name('laporan.show');
    Route::post('laporan/{pengaduan}/setujui', [PengaduanController::class, 'setujuiPenanganan'])->name('laporan.setujui');
    Route::post('laporan/{pengaduan}/tolak', [PengaduanController::class, 'tolakPengaduan'])->name('laporan.tolak');
    Route::post('laporan/{pengaduan}/selesaikan', [PengaduanController::class, 'selesaikanPengaduan'])->name('laporan.selesaikan');
    Route::resource('users', UserController::class);
    Route::post('print', [PengaduanController::class, 'print'])->name('print');
});

// --- GRUP UNTUK ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('laporan-masuk', [PengaduanController::class, 'laporanMasukAdmin'])->name('laporan.masuk');
    Route::get('laporan/{pengaduan}', [PengaduanController::class, 'showAdmin'])->name('laporan.show');
    Route::post('laporan/{pengaduan}/tangani', [PenangananController::class, 'store'])->name('laporan.tangani');
    Route::get('users', [UserController::class, 'indexAdmin'])->name('users.index');
    Route::post('users', [UserController::class, 'storeUser'])->name('users.store');
    Route::put('users/{user}', [UserController::class, 'updateUser'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroyUser'])->name('users.destroy');
    Route::get('users/{user}/edit', [UserController::class, 'editUser'])->name('users.edit');
    Route::get('users/create', [UserController::class, 'createUser'])->name('users.create');
});
