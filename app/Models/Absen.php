<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk memberi izin pengisian kolom
    protected $fillable = [
        'user_id',
        'waktu_absen',
    ];

    // Jika kamu punya relasi ke User, pastikan ini juga ada
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
