<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Redirect root (/) ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/dashboard', function () {
    return view('dashboard');
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

Route::get('/member/dashboard', function () {
    return view('member.dashboard');
})->name('member.dashboard');

Route::get('/member/data-saya', function () {
    return view('member.data-saya');
})->name('member.data');

Route::get('/member/rekap-absensi', function () {
    return view('member.rekap-absensi');
})->name('member.rekap');
