<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absen;
use Carbon\Carbon;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 

        // Hitung total kehadiran bulan ini
        $totalKehadiranBulanIni = Absen::where('user_id', $user->id)
            ->whereMonth('waktu_absen', Carbon::now()->month)
            ->whereYear('waktu_absen', Carbon::now()->year)
            ->count();

        // Ambil 5 riwayat terbaru
        $riwayatTerbaru = Absen::where('user_id', $user->id)
            ->orderBy('waktu_absen', 'desc')
            ->take(5)
            ->get();

        return view('member.dashboard', compact('user', 'totalKehadiranBulanIni', 'riwayatTerbaru'));
    }

    public function dataSaya()
    {
        $user = Auth::user(); 
        return view('member.data-saya', compact('user'));
    }
}
