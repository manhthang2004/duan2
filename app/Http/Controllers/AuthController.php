<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->route('dashboard');
            }
            return redirect()->route('dashboard');
        }
    
        return redirect()->back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }
    

    public function dashboard()
    {
        $user = Auth::user();

        if (is_null($user)) {
            return redirect()->route('login.form');
        }

        return view('dashboard', ['user' => $user]);
    }

    public function showAdmin()
    {
        $user = Auth::user();

        if (is_null($user)) {
            return redirect()->route('login.form');
        }

        return view('admin.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tạo người dùng mới
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::attempt([
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        return redirect()->route('dashboard');
    }
}
