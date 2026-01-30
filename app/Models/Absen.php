<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absens'; // Pastikan nama tabelnya benar

    protected $fillable = [
        'user_id',
        'waktu_absen',
        'sisa_sesi_snapshot', // <--- TAMBAHKAN INI! Tanpa ini, data nggak akan masuk.
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
