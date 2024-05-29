<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.landingpage');
});

// admin
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/admin/produk', function () {
    $produk = Product::all();
    return view('admin.produk.produk', compact('produk'));
});
Route::post('/admin/produk/post', [ProductController::class, 'addProduk'])->name('admin.add.produk');
