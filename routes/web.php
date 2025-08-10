<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PenangananController;
use App\Http\Controllers\UserController;

// Halaman Awal (jika diperlukan)
Route::get('/', function () {
    // Arahkan ke login jika belum login
    return redirect()->route('login.form');
});

// Rute Autentikasi
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// --- GRUP UNTUK SUPERADMIN ---
Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Pengaduan untuk Superadmin
    Route::get('laporan-masuk', [PengaduanController::class, 'laporanMasukSuperAdmin'])->name('laporan.masuk');
    Route::get('laporan-selesai', [PengaduanController::class, 'laporanSelesai'])->name('laporan.selesai');
    Route::get('laporan-ditolak', [PengaduanController::class, 'laporanDitolak'])->name('laporan.ditolak');
    Route::get('laporan/{pengaduan}', [PengaduanController::class, 'show'])->name('laporan.show');

    // Aksi Pengaduan
    Route::post('laporan/{pengaduan}/setujui', [PengaduanController::class, 'setujuiPenanganan'])->name('laporan.setujui');
    Route::post('laporan/{pengaduan}/tolak', [PengaduanController::class, 'tolakPengaduan'])->name('laporan.tolak');
    Route::post('laporan/{pengaduan}/selesaikan', [PengaduanController::class, 'selesaikanPengaduan'])->name('laporan.selesaikan');

    // Management Account (CRUD untuk semua role)
    Route::resource('users', UserController::class);

    // Fitur Print (dapat dikembangkan lebih lanjut)
    Route::post('print', [PengaduanController::class, 'print'])->name('print');
});


// --- GRUP UNTUK ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('laporan-masuk', [PengaduanController::class, 'laporanMasukAdmin'])->name('laporan.masuk');
    Route::get('laporan/{pengaduan}', [PengaduanController::class, 'showAdmin'])->name('laporan.show');

    // Penanganan oleh Admin
    Route::post('laporan/{pengaduan}/tangani', [PenangananController::class, 'store'])->name('laporan.tangani');

    // Management Account (hanya bisa CRUD User)
    Route::get('users', [UserController::class, 'indexAdmin'])->name('users.index');
    Route::post('users', [UserController::class, 'storeUser'])->name('users.store');
    Route::put('users/{user}', [UserController::class, 'updateUser'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroyUser'])->name('users.destroy');
    Route::get('users/{user}/edit', [UserController::class, 'editUser'])->name('users.edit');
    Route::get('users/create', [UserController::class, 'createUser'])->name('users.create');
});

// Rute untuk user biasa (pelapor) bisa ditambahkan di sini
// Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
//     // ... rute untuk user ...
// });
