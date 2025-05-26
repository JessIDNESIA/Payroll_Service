<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Role Buat Admin
Route::middleware(['auth','role:admin'])->group(function () {
    Route::resource('gaji', GajiController::class);
    Route::get('gaji', [GajiController::class, 'index'])->name('gaji.index'); // admin lihat semua gaji
    Route::get('/gaji/create', [GajiController::class, 'create'])->name('gaji.create');
    Route::post('/gaji/{id}/bayar', [GajiController::class, 'bayar'])->name('gaji.bayar');
    Route::patch('/gaji/{id}/status', [GajiController::class, 'updateStatus'])->name('gaji.updateStatus');
    Route::get('/gaji/{id}', [GajiController::class, 'show'])->name('gaji.show');
    Route::get('/admin/gaji/{gaji}/edit', [GajiController::class, 'edit'])->name('gaji.edit');
    Route::put('/admin/gaji/{gaji}', [GajiController::class, 'update'])->name('gaji.update');



    // 🔽 Pengajuan Admin tanpa prefix admin (bisa dihapus nanti kalau sudah pakai admin prefix)
    Route::resource('pengajuan', PengajuanController::class);
    Route::put('pengajuan/{id}/setujui', [PengajuanController::class, 'setujui'])->name('pengajuan.setujui');
    Route::put('pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name('pengajuan.tolak');
});

// Group baru dengan prefix 'admin' dan name prefix 'admin.'
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('pengajuan', PengajuanController::class);
    Route::put('pengajuan/{id}/setujui', [PengajuanController::class, 'setujui'])->name('pengajuan.setujui');
    Route::put('pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name('pengajuan.tolak');
});

// ✅ Route untuk user biasa (hanya lihat gaji milik sendiri dan bayar)
Route::middleware('auth')->group(function () {
    // Masalah Gaji
    Route::get('gaji', [GajiController::class, 'index'])->name('gaji.index'); // user lihat gajinya sendiri
    Route::post('/gaji/{id}/bayar', [GajiController::class, 'bayar'])->name('gaji.bayar');

    // Masalah pengajuan
    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('user.pengajuan.index');
    Route::get('pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('pengajuan/{pengajuan}', [PengajuanController::class, 'show'])
        ->name('pengajuan.show'); // ⬅️ Tambahkan ini

    

    // Profil routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
