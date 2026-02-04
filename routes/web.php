<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Absen;
use Carbon\Carbon;
use Illuminate\Http\Request;

// 1. GUEST / AUTH ROUTES
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// 2. MEMBER ROUTES (Dikelompokkan jadi satu biar gak nyasar)
Route::middleware(['auth', 'role:member'])->group(function() {
    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/member/data-saya', [MemberDashboardController::class, 'dataSaya'])->name('member.data-saya');
    Route::get('/member/rekap-absensi', [AbsenController::class, 'indexMember'])->name('member.rekap');
});

// 3. ADMIN ROUTES
Route::middleware(['auth', 'role:admin'])->group(function() {
    // Dashboard Admin Utama
    Route::get('/dashboard', function () {
        $totalMember = User::count();
        $reguler = User::where('paket', 'reguler')->count();
        $unlimited = User::where('paket', 'unlimited')->count();
        $semuaAbsenHariIni = Absen::whereDate('waktu_absen', Carbon::today())->get();
        $absenLimit = Absen::with('user')
                        ->whereDate('waktu_absen', Carbon::today())
                        ->orderBy('waktu_absen', 'desc')
                        ->take(5)
                        ->get();

        return view('dashboard', compact('totalMember', 'reguler', 'unlimited', 'semuaAbsenHariIni', 'absenLimit'));
    })->name('dashboard');

    // Manajemen Member oleh Admin
    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/tambah', [MemberController::class, 'create'])->name('member.tambah');
    Route::post('/member/tambah', [MemberController::class, 'store'])->name('member.store');
    Route::get('/member/edit/{user}', [MemberController::class, 'edit'])->name('member.edit');
    Route::put('/member/update/{user}', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/member/delete/{user}', [MemberController::class, 'destroy'])->name('member.destroy');
    Route::get('/member/download-qr/{id}', [MemberController::class, 'downloadQr'])->name('member.downloadQr');

    // Scanner & Proses Absen
    Route::get('/scanner', function () { return view('scanner'); })->name('tampil.scanner');
    Route::post('/proses-absen', [AbsenController::class, 'prosesAbsen'])->name('proses.absen');

    // Rekap untuk Admin
    // GANTI SEMUA ROUTE /rekap YANG ADA DENGAN INI:
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/rekap', function (Illuminate\Http\Request $request) {
        $search = $request->query('search');
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        $query = App\Models\Absen::with('user');

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

        // PENTING: Gunakan paginate(), JANGAN get()
        $dataAbsen = $query->orderBy('waktu_absen', 'desc')
                           ->paginate(10) 
                           ->withQueryString(); 

        return view('rekap', compact('dataAbsen'));
    })->name('rekap.index');
});
});