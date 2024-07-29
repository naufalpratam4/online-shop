<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class validateForm extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek peran (role) pengguna
            if ($user->role == 'Admin') { // Contoh: isAdmin() adalah metode di model User untuk mengecek apakah pengguna adalah admin
                return redirect('/admin');
            } else {
                return redirect('/');
            }
        }

        // Jika tidak berhasil login, tampilkan pesan error
        if (!$request->filled('email') || !User::where('email', $request->input('email'))->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email yang Anda masukkan tidak terdaftar.']);
        }

        return redirect()->back()->withErrors(['password' => 'Password salah']);
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:users',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa format email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus terdiri dari 6 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 15 digit.',
        ]);

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['password'] = bcrypt($request->input('password'));
        $data['no_hp'] = $request->input('no_hp');
        $data['role'] = 'User';


        User::create($data);
        return redirect('/login')->with('success', 'Berhasil Register Akun, silahkan login');
    }
    public function logoutUser()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda telah logout');
    }
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'Admin') {
                return redirect('/admin');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Anda tidak memiliki akses sebagai Admin']);
            }
        }

        if (!$request->filled('email') || !User::where('email', $request->input('email'))->exists()) {
            return redirect()->back()->withErrors(['email' => 'Email yang Anda masukkan tidak terdaftar.']);
        }
        return redirect()->back()->withErrors(['password' => 'Password salah']);
    }
    public function registerAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'no_hp' => 'required|numeric|digits_between:10,15|unique:users',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa format email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus terdiri dari 6 karakter.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'no_hp.digits_between' => 'Nomor HP harus terdiri dari 10 hingga 15 digit.',
        ]);

        $data['name'] = $request->input('name');
        $data['email'] = $request->input('email');
        $data['password'] = bcrypt($request->input('password'));
        $data['no_hp'] = $request->input('no_hp');
        $data['role'] = 'Admin';


        User::create($data);
        return redirect('login-admin')->with('success', 'Berhasil Register Akun, silahkan login');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
