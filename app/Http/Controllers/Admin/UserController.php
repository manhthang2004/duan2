<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tel' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:1,2'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được tạo thành công.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'tel' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:1,2'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'address' => $request->address,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được cập nhật thành công.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Người dùng đã được xóa thành công.');
    }
}
