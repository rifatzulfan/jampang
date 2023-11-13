<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kegunaan', 'status', 'name', 'phone', 'message', 'asal'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
