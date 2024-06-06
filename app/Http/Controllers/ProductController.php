<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            // 'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'link' => 'nullable|url',
            'visible' => 'required|boolean',
            'kategori_id' => 'nullable|exists:kategoris,id', // Pastikan kategori_id ada di tabel kategoris
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $path = $file->store('foto_produk'); // Store the file and get its path
            $produk['foto_produk'] = $path;
        }
        if ($request->hasFile('foto_produk')) {
            $photo = $request->file('foto_produk');
            $filename = $photo->getClientOriginalName();
            $path = 'public/foto_produk/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($photo));
            $produk['foto_produk'] = $path;
        }
        $produk['nama_produk'] = $request->input('nama_produk');

        $produk['deskripsi'] = $request->input('deskripsi');
        $produk['harga'] = $request->input('harga');
        $produk['link'] = $request->input('link');
        $produk['visible'] = $request->input('visible');
        $produk['kategori_id'] = $request->input('kategori_id');

        Product::create($produk);
        return redirect()->back()->with('success', 'Berhasil menambahkan data produk');
    }
    public function visible(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Set nilai visible sesuai dengan checkbox
        $product->visible = $request->input('visible') ? true : false;


        // Simpan perubahan
        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Status visibility produk telah diubah.');
    }

    public function deleteProduct($id)
    {
        $produk = Product::find($id);
        $produk->delete();
    }
}
