<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Peminjaman;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = $request->input('cari');

        if ($request->has('clear')) {
            // Clear the search query
            $query = null;
        }
        $user_id = Auth::user()->id;

        $checkouts = Checkout::with('peminjaman')
            ->whereHas('peminjaman', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->when($query, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->input('cari') . '%')
                        ->orWhere('phone', 'like', '%' . $request->input('cari') . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(6)
            ->appends(['cari' => $query]);
        return view('user.transaksi.index', compact('checkouts'));
    }

    public function show($id)
    {
        $checkout = Checkout::with('peminjaman')->find($id);
        if (!$checkout) {
            abort(404);
        }
        // Mengembalikan view bersama dengan data $peminjaman
        return view('user.transaksi.detail', compact('checkout'));
    }
}
