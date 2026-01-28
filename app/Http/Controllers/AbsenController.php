<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen; // Pastikan Model Absen dipanggil
use App\Models\User;  // Pastikan Model User dipanggil

class AbsenController extends Controller
{
    // Fungsi untuk menampilkan halaman rekap
    public function index()
{
    // Mengambil data absen, diurutkan dari yang paling baru (descending)
    $dataAbsen = \App\Models\Absen::with('user')->orderBy('waktu_absen', 'desc')->get();
    
    return view('rekap', compact('dataAbsen'));
}

    // Fungsi untuk memproses hasil scan (Pindahan dari MemberController)
   public function prosesAbsen(Request $request)
{
    try {
        $user = \App\Models\User::find($request->user_id);
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Member tidak ditemukan!'], 404);
        }

        // --- TAMBAHKAN VALIDASI STATUS DI SINI ---
        // Asumsi: 1 adalah Aktif, 0 adalah Non-Aktif
        if ($user->status == 0) {
            return response()->json([
                'success' => false, 
                'message' => 'Status member Anda Non-Aktif, Anda tidak dapat melakukan absensi.'
            ], 403); // Error 403 artinya Forbidden/Dilarang
        }

        // Validasi tambahan: Cek sisa sesi jika paket Reguler
        if (strtolower($user->paket) == 'reguler' && $user->sisa <= 0) {
            return response()->json([
                'success' => false, 
                'message' => 'Sisa sesi Anda habis. Silakan top-up paket!'
            ], 403);
        }

        // Jika lolos validasi, baru simpan data absen
        \App\Models\Absen::create([
            'user_id' => $user->id,
            'waktu_absen' => now(),
        ]);

        // Potong sisa sesi jika reguler
        if (strtolower($user->paket) == 'reguler') {
            $user->decrement('sisa');
        }

        return response()->json(['success' => true, 'message' => $user->name]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }

    }
}

