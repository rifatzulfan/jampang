<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ScheduledApprove;
use App\Models\Kegunaan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Jadwal;
use App\Models\Instansi;
use Illuminate\Support\Facades\Mail;

class PeminjamanController extends Controller
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
        $peminjamen = Peminjaman::with('jadwals')
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
        return view('admin.peminjaman.index', compact('peminjamen'));
    }

    public function create()
    {
        $kegunaans = Kegunaan::all();
        $instansis = Instansi::all();
        return view('admin.peminjaman.create', compact('kegunaans', 'instansis'));
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
                            $fail("Jammulai dan jamselesai harus berbeda dengan jadwal lain pada tanggal yang sama.");
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
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman Sukses Ditambahkan.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('jadwals')->find($id);
        if (!$peminjaman) {
            abort(404);
        }

        $pdfPath = $peminjaman->surat;

        $path = url('storage/' . $pdfPath);
        // Mengembalikan view bersama dengan data $peminjaman
        return view('admin.peminjaman.detail', compact('peminjaman', 'pdfPath', 'path'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'message' => $request->status == 'ditolak' ? 'required' : ''
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Cari data peminjaman yang ingin diupdate
        $peminjaman = Peminjaman::findOrFail($id);

        // Perbarui data peminjaman
        $peminjaman->status = $request->status;
        $peminjaman->message = $request->message;
        $peminjaman->save();

        $user = $peminjaman->user;
        $jadwal = Jadwal::findOrFail($id);

        $scheduleApprove = new ScheduledApprove($user, null, $peminjaman, $jadwal);

        // Send email to the user
        Mail::to($user->email)->send($scheduleApprove);
        // Pass $peminjaman to the NewScheduleCreated Mailable

        // Redirect ke halaman sukses
        return redirect()->route('peminjaman.index')->with('success', 'Status Peminjaman Sukses Diperbarui.');
    }

    public function delete($id)
    {
        // Temukan peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->jadwals()->delete();
        $peminjaman->delete();

        // Redirect ke halaman sukses
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
