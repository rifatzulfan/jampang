<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kegunaan_id', 'surat', 'status', 'instansi_id', 'name', 'phone', 'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegunaan()
    {
        return $this->belongsTo(Kegunaan::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}
