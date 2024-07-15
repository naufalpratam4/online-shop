<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditUserDetailController extends Controller
{
    public function Name()
    {
        $user = auth()->user();
        User::findOrFail($user->id)->update([
            'name' => request('name')
        ]);
        return redirect()->back()->with('success', 'Berhasil edit Nama');
    }
    public function tgl_lahir()
    {
        $user = auth()->user();
        User::findOrFail($user->id)->update([
            'tgl_lahir' => request('tgl_lahir')
        ]);
        return redirect()->back()->with('success', 'Berhasil edit Nama');
    }
    public function jenis_kelamin()
    {
        $user = auth()->user();
        User::findOrFail($user->id)->update([
            'jenis_kelamin' => request('jenis_kelamin')
        ]);
        return redirect()->back()->with('success', 'Berhasil edit Nama');
    }
    public function email(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        // Update email
        User::findOrFail($user->id)->update([
            'email' => $request->email,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Berhasil edit Email');
    }

    public function no_hp()
    {
        $user = auth()->user();
        User::findOrFail($user->id)->update([
            'no_hp' => request('no_hp'),
        ]);
        return redirect()->back()->with('success', 'Berhasil edit alamat');
    }
    public function Alamat()
    {
        $user = auth()->user();
        User::findOrFail($user->id)->update([
            'alamat' => request('alamat'),
        ]);
        return redirect()->back()->with('success', 'Berhasil edit alamat');
    }
    public function password()
    {
        $user = auth()->user();
        User::findOrFail($user->id)->update([
            'password' => request('password')
        ]);
    }
}
