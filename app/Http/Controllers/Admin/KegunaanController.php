<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegunaan;
use Illuminate\Http\Request;

class KegunaanController extends Controller
{
    //

    public function index()
    {
        $kegunaans = Kegunaan::orderBy('id', 'desc')->paginate(6);
        return view('admin.kegunaan.index', compact('kegunaans'));
    }

    public function create()
    {
        return view('admin.kegunaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Kegunaan::create($request->post());

        return redirect()->route('kegunaan.index')->with('success', 'Kepentingan Sukses Ditambahkan.');
    }

    public function edit(Kegunaan $kegunaan)
    {
        return view('admin.kegunaan.edit', compact('kegunaan'));
    }

    public function update(Request $request, Kegunaan $kegunaan)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $kegunaan->fill($request->post())->save();

        return redirect()->route('kegunaan.index')->with('success', 'Kepentingan Sukses Diperbarui.');
    }
    public function destroy(Kegunaan $kegunaan)
    {
        $kegunaan->delete();
        return redirect()->route('kegunaan.index')->with('success', 'Kepentingan Sukses Dihapus');
    }
}
