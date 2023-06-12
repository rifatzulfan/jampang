<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Checkout;

class SewaController extends Controller
{
    //

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'staff' => 'required'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->staff_id = $validatedData['staff'];
        $peminjaman->save();

        $checkout = new Checkout;
        $checkout->peminjaman_id = $peminjaman->id;
        $checkout->status = 'Menunggu Pembayaran';
        $checkout->save();

        return redirect()->route('peminjaman-user.show', ['id' => $id])->with('success', 'Penyewaan Staff Sukses Diajukan.');
    }
}
