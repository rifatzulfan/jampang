<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //


    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(6);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        $data = $request->post();
        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect()->route('user.index')->with('success', 'User Sukses Ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $defaultRoleId = $user->role_id;
        return view('admin.user.edit', compact('user', 'roles', 'defaultRoleId'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'phone' => 'required',
            'role_id' => 'required',
        ]);

        $data = $request->post();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // If the password field is empty, retain the old password value
            $data['password'] = $user->getOriginal('password');
        }

        $user->fill($data)->save();

        return redirect()->route('user.index')->with('success', 'User Sukses Diperbarui.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Sukses Dihapus');
    }
}
