<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class SuksesPageController extends Controller
{
    //
    public function index($id)
    {
        $peminjaman = Peminjaman::with('checkouts', 'jadwals')->findOrFail($id); // Assuming you have a Peminjaman model

        return view('sukses', ['peminjaman' => $peminjaman]);
    }
}
