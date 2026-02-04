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

public function indexMember(Request $request)
{
    // 1. Mulai query dari model Absen untuk user yang sedang login
    $query = \App\Models\Absen::where('user_id', auth()->id());

    // 2. Filter berdasarkan Bulan jika ada input
    if ($request->has('bulan') && $request->bulan != '') {
        $query->whereMonth('waktu_absen', $request->bulan);
    }

    // 3. Filter berdasarkan Tahun jika ada input
    if ($request->has('tahun') && $request->tahun != '') {
        $query->whereYear('waktu_absen', $request->tahun);
    }

    // 4. Urutkan dari yang terbaru dan aktifkan Pagination (10 data per halaman)
    // appends(request()->all()) penting agar saat pindah halaman filter tidak hilang
    $dataAbsen = $query->orderBy('waktu_absen', 'desc')
                       ->paginate(10)
                       ->appends($request->all()); 

    return view('member.rekap-absensi', compact('dataAbsen'));
}

    // Fungsi untuk memproses hasil scan (Pindahan dari MemberController)
   public function prosesAbsen(Request $request)
{
    try {
        $user = \App\Models\User::find($request->user_id);
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Member tidak ditemukan!'], 404);
        }

        if ($user->status == 0) {
            return response()->json([
                'success' => false, 
                'message' => 'Status member Anda Non-Aktif, Anda tidak dapat melakukan absensi.'
            ], 403);
        }

        // Validasi sisa sesi
        if (strtolower($user->paket) == 'reguler' && $user->sisa <= 0) {
            return response()->json([
                'success' => false, 
                'message' => 'Sisa sesi Anda habis. Silakan top-up paket!'
            ], 403);
        }

        // --- PERBAIKAN DI SINI ---
        
        // 1. Kurangi sisa sesi TERLEBIH DAHULU di database
        if (strtolower($user->paket) == 'reguler') {
            $user->decrement('sisa');
            // Refresh data user agar variabel $user->sisa terupdate dengan angka terbaru
            $user->refresh(); 
        }

        // 2. Baru simpan data absen dengan snapshot sisa yang SUDAH BERKURANG
        \App\Models\Absen::create([
            'user_id' => $user->id,
            'waktu_absen' => now(),
            'sisa_sesi_snapshot' => $user->sisa, // Sekarang nilainya sudah berkurang
        ]);

        return response()->json(['success' => true, 'message' => $user->name]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
    }
}
    

    
}

