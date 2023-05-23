<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::user()->id;

        $peminjamen = Peminjaman::with('jadwals')
            ->where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('user.peminjaman.index', compact('peminjamen'));
    }
}
