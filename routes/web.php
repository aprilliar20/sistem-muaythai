<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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

