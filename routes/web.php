<?php

use Illuminate\Support\Facades\Route;

// Redirect root (/) ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses login (POST)
Route::post('/login', function () {
    // nanti isi logic autentikasi di sini
})->name('login.process');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/member', function () {
    return view('member');
});

Route::get('/edit', function () {
    return view('edit');
})->name('member.edit');




