<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'member')->get();
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
            'email' => 'required|email|unique:users',
            'paket' => 'nullable',
            'status' => 'nullable',
        ]);

        $validated['role'] = 'member';
        $validated['password'] = bcrypt('123456');

        User::create($validated);

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambahkan');
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
}
