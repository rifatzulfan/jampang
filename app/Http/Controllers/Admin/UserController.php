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
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $data = $request->post();
        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect()->route('user.index')->with('success', 'User Sukses Ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));

    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:8|nullable',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $data = $request->post();

        $user->fill($data)->save();
        return redirect()->route('user.index')->with('success', 'User Sukses Diperbarui.');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Sukses Dihapus');
    }
}
