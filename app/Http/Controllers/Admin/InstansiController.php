<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    //

    public function index()
    {
        $instansis = Instansi::orderBy('id', 'desc')->paginate(6);
        return view('admin.instansi.index', compact('instansis'));
    }

    public function create()
    {
        return view('admin.instansi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Instansi::create($request->post());

        return redirect()->route('instansi.index')->with('success', 'instansi Sukses Ditambahkan.');
    }

    public function edit(Instansi $instansi)
    {
        return view('admin.instansi.edit', compact('instansi'));
    }

    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $instansi->fill($request->post())->save();

        return redirect()->route('instansi.index')->with('success', 'instansi Sukses Diperbarui.');
    }
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();
        return redirect()->route('instansi.index')->with('success', 'instansi Sukses Dihapus');
    }
}
