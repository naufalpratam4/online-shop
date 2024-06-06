<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class validateForm extends Controller
{
    public function registerUser(Request $request)
    {
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');
        $data['no_hp'] = $request->input('no_hp');

        User::create($data);
        return redirect()->back()->with('success', 'Berhasil Register Akun, silahkan login');
    }
}
