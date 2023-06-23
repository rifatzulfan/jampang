<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = $request->input('cari');
        $payment_status = $request->input('payment_status');

        if ($request->has('clear')) {
            // Clear the search query
            $query = null;
            $payment_status = null;
        }
        $checkouts = Checkout::when($query, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('peminjaman', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->input('cari') . '%');
                });
            });
        })->when($payment_status, function ($query) use ($payment_status) {
            $query->where('payment_status', $payment_status);
        })
            ->orderBy('id', 'desc')
            ->paginate(6)
            ->appends(['cari' => $query]);
        return view('admin.transaksi.index', compact('checkouts'));
    }

    public function show($id)
    {
        $checkout = Checkout::with('peminjaman')->find($id);
        if (!$checkout) {
            abort(404);
        }
        // Mengembalikan view bersama dengan data $peminjaman
        return view('admin.transaksi.detail', compact('checkout'));
    }
}
