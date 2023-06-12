<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'bukti_payment'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
