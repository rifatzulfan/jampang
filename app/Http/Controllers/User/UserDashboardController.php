<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //
    public function index(Request $request)
    {

        $query = $request->input('cari');
        $status = $request->input('status');

        if ($request->has('clear')) {
            // Clear the search query
            $query = null;
            $status = null;
        }
        $user_id = Auth::user()->id;

        $peminjamen = Peminjaman::with('jadwals')
            ->where('user_id', $user_id)
            ->when($query, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->input('cari') . '%')
                        ->orWhere('phone', 'like', '%' . $request->input('cari') . '%');
                });
            })->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('id', 'desc')
            ->paginate(6)
            ->appends(['cari' => $query]);


        return view('user.peminjaman.index', compact('peminjamen'));
    }

    public function show($id)
    {

        $peminjaman = Peminjaman::with('jadwals')->find($id);
        if (!$peminjaman) {
            abort(404);
        }

        // Mengembalikan view bersama dengan data $peminjaman
        return view('user.peminjaman.detail', compact('peminjaman'));
    }

    public function cancelPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Check if the peminjaman is in a cancelable status
        if ($peminjaman->status === 'diproses') {
            // Change the status to 'ditolak'
            $peminjaman->status = 'dibatalkan';
            $peminjaman->save();

            // Optionally, you can send a notification or perform additional actions here

            return redirect()->route('peminjaman-user.index')->with('success', 'Peminjaman berhasil dibatalkan.');
        }

        return redirect()->route('peminjaman-user.index')->with('error', 'Peminjaman tidak dapat dibatalkan.');
    }
}
