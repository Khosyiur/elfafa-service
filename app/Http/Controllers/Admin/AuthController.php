<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Halaman login
    public function showLogin()
    {
        // Redirect jika sudah login
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()
                ->withInput()
                ->with('error', 'Username atau password salah.');
        }

        // Simpan session
        session([
            'admin_id' => $admin->id,
            'admin_username' => $admin->username,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Selamat datang, ' . $admin->username . '!');
    }

    // Logout
    public function logout()
    {
        session()->forget(['admin_id', 'admin_username']);

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah logout.');
    }
}