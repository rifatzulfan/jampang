<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = $request->input('cari');

        if ($request->has('clear')) {
            // Clear the search query
            $query = null;
        }
        $staffs = Staff::when($query, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->input('cari') . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(6)
            ->appends(['cari' => $query]);
        return view('admin.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        Staff::create($request->post());

        return redirect()->route('staff.index')->with('success', 'Staff Sukses Ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $staff->fill($request->post())->save();

        return redirect()->route('staff.index')->with('success', 'Staff Sukses Diperbarui.');
    }
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('success', 'Staff Sukses Dihapus');
    }
}
