<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberDashboardController;



Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//admin
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/member', function () {
    return view('member');
});

Route::get('/edit', function () {
    return view('edit');
})->name('member.edit');

Route::get('/member/tambah', function () {
    return view('member-tambah');
})->name('member.tambah');

Route::get('/rekap', function () {
    return view('rekap');
});


//member
Route::middleware(['auth', 'role:member'])->group(function() {
    Route::get('/member/dashboard', function() {
        return view('member.dashboard');
    })->name('member.dashboard');
});

Route::get('/member/dashboard', function () {
    return view('member.dashboard');
})->name('member.dashboard');

Route::get('/member/data-saya', function () {
    return view('member.data-saya');
})->name('member.data');

Route::get('/member/rekap-absensi', function () {
    return view('member.rekap-absensi');
})->name('member.rekap');


Route::middleware(['auth', 'role:admin'])->group(function() {

    Route::get('/member', [MemberController::class, 'index'])->name('member.index');

    Route::get('/member/tambah', [MemberController::class, 'create'])->name('member.tambah');

    Route::post('/member/tambah', [MemberController::class, 'store'])->name('member.store');

    Route::get('/member/edit/{user}', [MemberController::class, 'edit'])->name('member.edit');

    Route::put('/member/update/{user}', [MemberController::class, 'update'])->name('member.update');

    Route::delete('/member/delete/{user}', [MemberController::class, 'destroy'])->name('member.destroy');
});


// Pastikan member harus login dulu baru bisa buka halaman ini
Route::get('/member/data-saya', [MemberDashboardController::class, 'index'])->middleware('auth');


// Halaman untuk membuka kamera scanner
Route::get('/scanner', function () {
    return view('scanner'); // Sesuaikan dengan nama file kamu
})->name('tampil.scanner');

use App\Http\Controllers\AbsenController;

// Ganti route yang lama dengan ini
Route::get('/rekap', [AbsenController::class, 'index'])->name('rekap.index');
Route::post('/proses-absen', [AbsenController::class, 'prosesAbsen'])->name('proses.absen');