<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function kategoriPost(Request $request)
    {
        $data['nama_kategori'] = $request->input('nama_kategori');

        Kategori::create($data);
        return redirect()->back()->with('success', 'Berhasil menambahkan kategori');
    }
}
