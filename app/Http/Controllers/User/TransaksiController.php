<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

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

        $checkouts = Checkout::with('peminjaman')->when($query, function ($query) use ($request) {
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
}
