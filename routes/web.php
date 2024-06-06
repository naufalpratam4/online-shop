<?php

use App\Http\Controllers\auth\validateForm;
use App\Http\Controllers\ProductController;
use App\Models\Kategori;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $produk = Product::where('visible', 1)->get();
    return view('user.landingpage', compact('produk'));
});
Route::get('/cart', function () {
    return view('user.cart.cart');
});
Route::get('product-detail', function () {
    return view('user.product.productDetail');
});
Route::get('/user-detail', function () {
    return view('user.profile.userProfile');
});

Route::get('/login', function () {
    return view('user.auth.loginUser');
});
Route::get('/register', function () {
    return view('user.auth.registerUser');
});
Route::post('/register', [validateForm::class, 'registerUser'])->name('register.user');
// admin
Route::get('/admin', function () {
    return view('admin.index');
});
Route::get('/admin/produk', function () {
    $produk = Product::with('kategori')->get();
    $kategori = Kategori::all();
    $produkTotal = Product::count();
    $produkTersedia = Product::where('visible', 1)->count();
    return view('admin.produk.produk', compact('produk', 'kategori', 'produkTotal', 'produkTersedia'));
});
Route::post('/admin/produk/post', [ProductController::class, 'addProduk'])->name('admin.add.produk');
Route::post('/admin/produk/visible/{id}', [ProductController::class, 'visible'])->name('admin.produk.visible');
Route::delete('/admin/produk/delete/{id}', [ProductController::class, 'deleteProduct'])->name('admin.delete.produk');
