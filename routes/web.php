<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberDashboardController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Absen;
use Carbon\Carbon;



Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');

// Pastikan pakainya Route::post, bukan Route::get
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');


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

Route::get('/member/download-qr/{id}', [MemberController::class, 'downloadQr'])->name('member.downloadQr');



Route::get('/dashboard', function () {
    // 1. Hitung total member
    $totalMember = User::count();
    
    // 2. Hitung berdasarkan paket
    $reguler = User::where('paket', 'reguler')->count();
    $unlimited = User::where('paket', 'unlimited')->count();
    
    // 1. Ambil SEMUA data absen hari ini (untuk angka total di pojok kanan)
    $semuaAbsenHariIni = Absen::whereDate('waktu_absen', \Carbon\Carbon::today())->get();
    
    // 2. Ambil hanya 5 data TERBARU (untuk isi tabel)
    $absenLimit = Absen::with('user')
                    ->whereDate('waktu_absen', \Carbon\Carbon::today())
                    ->orderBy('waktu_absen', 'desc')
                    ->take(5)
                    ->get();

    // 4. Kirim semua data ke view dashboard.blade.php
    return view('dashboard', compact('totalMember', 'reguler', 'unlimited', 'semuaAbsenHariIni', 'absenLimit'));
})->name('dashboard');


use Illuminate\Http\Request;
// ... (use lainnya)

// GANTI SEMUA ROUTE /rekap YANG ADA DENGAN INI:

Route::get('/rekap', function (Illuminate\Http\Request $request) {
    $search = $request->query('search');
    $bulan = $request->query('bulan');
    $tahun = $request->query('tahun');

    $query = Absen::with('user');

    if ($search) {
        $query->whereHas('user', function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });
    }

    if ($bulan) {
        $query->whereMonth('waktu_absen', $bulan);
    }

    if ($tahun) {
        $query->whereYear('waktu_absen', $tahun);
    }

    // Pakai paginate(10) supaya pagination jalan
    $dataAbsen = $query->orderBy('waktu_absen', 'desc')
                       ->paginate(10)
                       ->withQueryString(); 

    return view('rekap', compact('dataAbsen'));
})->name('rekap.index'); // Kuncinya di sini, pakai .index!