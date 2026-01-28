<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Absen;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class MemberController extends Controller
{
    public function index(Request $request)
{
    // Ambil kata kunci dari input search
    $search = $request->input('search');

    // Query dasar: ambil yang rolenya member
    $query = User::where('role', 'member');

    // Jika ada kata kunci, filter berdasarkan nama atau email
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    // Paginate hasil akhirnya (10 data per halaman)
    // appends(request()->query()) supaya kalau pindah halaman, hasil search-nya tidak hilang
    $members = $query->paginate(10)->appends($request->query());

    return view('member', compact('members'));
}

   public function create()
{
    return view('member-tambah');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name'  => 'required',
        'no_hp' => 'required',
        'sisa' => 'required|integer',
        'masa_aktif' => 'required|date',
        'password' => 'required|min:6',
        'email' => 'required|email|unique:users,email',
        'paket' => 'required',
        'status' => 'required', // bisa aktif / non
        'role'  => 'required',
    ]);


    $validated['status'] = (int) $request->status;

    // hash password
    $validated['password'] = bcrypt($validated['password']);

    User::create($validated);

    return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan!');
}


    public function edit(User $user)
    {
        return view('edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name'  => 'required',
        'no_hp' => 'required',
        'sisa' => 'required',
        'masa_aktif' => 'required',
        'password' => 'nullable|min:6',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'paket' => 'nullable',
        'status' => 'nullable',
    ]);

   if ($request->has('status')) {
        $validated['status'] = (int) $request->status;
    }

    // handle password jika diisi
    if ($request->filled('password')) {
        $validated['password'] = bcrypt($request->password);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('member.index')->with('success', 'Member berhasil diperbarui');
}

    

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus');
    }

   public function downloadQr($id)
{
    $user = \App\Models\User::findOrFail($id);
    
    // Kita ganti format('png') jadi format('svg')
    // SVG tetap bisa dibuka di HP dan sangat tajam saat di-scan
    $image = QrCode::format('svg')
                 ->size(500)
                 ->margin(2)
                 ->generate($user->id);

    return response($image)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Content-Disposition', 'attachment; filename="QR_'.$user->name.'.svg"');
}}