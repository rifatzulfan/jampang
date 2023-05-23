<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Kegunaan;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    //

    public function index()
    {
        $kegunaans = Kegunaan::all();
        $instansis = Instansi::all();
        return view('peminjaman', compact('kegunaans', 'instansis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'instansi' => 'required',
            'kegunaan' => 'required',
            'surat' => 'required|file|mimes:pdf',
            'moreFields.*.tanggal' => 'required|date',
            'moreFields.*.jammulai' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    foreach ($request->moreFields as $key => $data) {
                        $jadwal = Jadwal::where('tanggal', $data['tanggal'])
                            ->whereHas('peminjaman', function ($query) {
                                $query->where('status', 'diterima');
                            })
                            ->where(function ($query) use ($data) {
                                $query->whereBetween('jammulai', [$data['jammulai'], $data['jamselesai']])
                                    ->orWhereBetween('jamselesai', [$data['jammulai'], $data['jamselesai']])
                                    ->orWhere(function ($query) use ($data) {
                                        $query->where('jammulai', '<', $data['jammulai'])
                                            ->where('jamselesai', '>', $data['jammulai']);
                                    })
                                    ->orWhere(function ($query) use ($data) {
                                        $query->where('jammulai', '<', $data['jamselesai'])
                                            ->where('jamselesai', '>', $data['jamselesai']);
                                    });
                            })
                            ->first();


                        if ($jadwal && $key !== $attribute) {
                            $fail("Jam yang kamu pilih tabrakan
                            Pilih tanggal atau jam yang kosong yaa!!");
                        }
                    }
                },
            ],
            'moreFields.*.jamselesai' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Upload file PDF
        $file = $request->file('surat');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/pdf', $filename);
        $publicPath = str_replace('public/', '', $path);

        // Simpan data peminjaman ke database
        $peminjaman = new Peminjaman;
        $peminjaman->user_id = auth()->user()->id;
        $peminjaman->name = $request->name;
        $peminjaman->phone = $request->phone;
        $peminjaman->kegunaan_id = $request->kegunaan;
        $peminjaman->instansi_id = $request->instansi;
        $peminjaman->surat = $publicPath;
        $peminjaman->status = 'diproses';
        $peminjaman->save();

        // Simpan data jadwal ke database
        foreach ($request->moreFields as $key => $value) {
            $jadwal = new Jadwal;
            $jadwal->tanggal = $value['tanggal'];
            $jadwal->jammulai = $value['jammulai'];
            $jadwal->jamselesai = $value['jamselesai'];
            $jadwal->peminjaman_id = $peminjaman->id;
            $jadwal->save();
        }

        // Redirect ke halaman sukses
        return redirect()->route('success.index');
    }
}
