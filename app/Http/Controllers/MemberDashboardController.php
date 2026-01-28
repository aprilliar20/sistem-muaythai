<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function index()
{
    // 1. Ambil data orang yang sedang login
    $user = \Illuminate\Support\Facades\Auth::user(); 

    // 2. Kirim data tersebut ke view 'member.data-saya'
    // Pastikan folder dan nama filenya benar (member/data-saya)
    return view('member.data-saya', compact('user'));
}
}
