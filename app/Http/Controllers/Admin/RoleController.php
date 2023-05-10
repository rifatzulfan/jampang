<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    //


    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(6);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Role::create($request->post());

        return redirect()->route('role.index')->with('success', 'Role Sukses Ditambahkan.');
    }

    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role->fill($request->post())->save();

        return redirect()->route('role.index')->with('success', 'Role Sukses Diperbarui.');
    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role Sukses Dihapus');
    }
}
