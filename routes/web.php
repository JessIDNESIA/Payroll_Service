<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===================================================
// Group ADMIN — semua route khusus admin
// ===================================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Gaji (admin) — resource tanpa edit/update/index/show (didefinisi manual untuk URL yang tepat)
    Route::resource('gaji', GajiController::class)->only(['create', 'store', 'destroy']);
    Route::get('gaji', [GajiController::class, 'index'])->name('gaji.index');
    Route::get('gaji/{id}', [GajiController::class, 'show'])->name('gaji.show');
    Route::post('gaji/{id}/bayar', [GajiController::class, 'bayar'])->name('gaji.bayar');
    Route::patch('gaji/{id}/status', [GajiController::class, 'updateStatus'])->name('gaji.updateStatus');
    Route::get('admin/gaji/{gaji}/edit', [GajiController::class, 'edit'])->name('gaji.edit');
    Route::put('admin/gaji/{gaji}', [GajiController::class, 'update'])->name('gaji.update');

    // Pengajuan (admin) dengan prefix admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('pengajuan', PengajuanController::class);
        Route::put('pengajuan/{id}/setujui', [PengajuanController::class, 'setujui'])->name('pengajuan.setujui');
        Route::put('pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name('pengajuan.tolak');

        // Presensi Admin
        Route::get('presensi', \App\Livewire\AdminPresence::class)->name('presensi.index');
    });
});

// ===================================================
// Group USER BIASA dan semua auth user
// ===================================================
Route::middleware('auth')->group(function () {
    // Pengajuan (user)
    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('user.pengajuan.index');
    Route::get('pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('pengajuan/{pengajuan}', [PengajuanController::class, 'show'])->name('pengajuan.show');

    // Profil routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Presensi Karyawan
    Route::get('/presensi', \App\Livewire\Presence::class)->name('presensi');
});

require __DIR__ . '/auth.php';
