<?php

namespace App\Http\Controllers;

use App\Models\Kegunaan;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Jadwal;

class PeminjamanController extends Controller
{
    //

    public function index()
    {
        $kegunaans = Kegunaan::all();
        return view('peminjaman', compact('kegunaans'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'kegunaan' => 'required|numeric',
    //         'surat' => 'required|file|mimes:pdf',
    //         'tanggal.*' => 'required|date_format:Y-m-d',
    //         'jammulai.*' => 'required|string',
    //         'jamselesai.*' => 'required|string|after:jammulai.*'
    //     ]);

    //     $peminjaman = Peminjaman::create([
    //         'user_id' => auth()->user()->id,
    //         'kegunaan_id' => $request->input('kegunaan'),
    //         'surat' => $request->file('surat')->store('pdf'),
    //         'status' => 'on progress'
    //     ]);

    //     $juml = count($request->input('tanggal', []));

    //     for ($i = 0; $i < $juml; $i++) {
    //         Jadwal::create([
    //             'peminjaman_id' => $peminjaman->id,
    //             'tanggal' => $request->input('tanggal.' . $i),
    //             'jammulai' => $request->input('jammulai.' . $i),
    //             'jamselesai' => $request->input('jamselesai.' . $i)
    //         ]);
    //         dd('Jadwal berhasil dibuat');
    //     }

    //     return redirect()->route('form-peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'kegunaan' => 'required|numeric',
            'surat' => 'required|file|mimes:pdf',
            'tanggal.*' => 'required|date_format:Y-m-d',
            'jammulai.*' => 'required|string',
            'jamselesai.*' => 'required|string|after:jammulai.*'
        ]);

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->user()->id,
            'kegunaan_id' => $request->input('kegunaan'),
            'surat' => $request->file('surat')->store('pdf'),
            'status' => 'on progress'
        ]);

        $juml = count($request->input('tanggal'));

        for ($i = 0; $i < $juml; $i++) {
            Jadwal::create([
                'peminjaman_id' => $peminjaman->id,
                'date' => $request->input('tanggal.' . $i),
                'start_time' => $request->input('jammulai.' . $i),
                'end_time' => $request->input('jamselesai.' . $i)
            ]);
        }

        return redirect()->route('welcome')->with('success', 'Peminjaman berhasil ditambahkan.');
    }
}
