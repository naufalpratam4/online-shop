<?php

use App\Http\Controllers\auth\validateForm;
use App\Http\Controllers\Dasboard\DashboardController;
use App\Http\Controllers\Data_transaksi\DataTransaksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Admin;
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
Route::post('/login', [validateForm::class, 'login'])->name('login.user');
Route::get('/register', function () {
    return view('user.auth.registerUser');
});
Route::post('/register', [validateForm::class, 'registerUser'])->name('register.user');


// admin
Route::get('/login-admin', function () {
    return view('admin.auth.loginUser');
});

Route::post('/login-admin', [ValidateForm::class, 'loginAdmin'])->name('login.admin');
Route::get('/register-admin', function () {
    return view('admin.auth.registerUser');
})->name('register.admin');

Route::post('/register-admin', [ValidateForm::class, 'registerAdmin'])->name('register.admin');


Route::middleware(['Admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
});
// Admin produk
Route::get('/admin/produk', [ProductController::class, 'index']);
Route::get('/admin/produk/{nama_produk}', [ProductController::class, 'productId'])->name('admin.productId');
Route::post('/admin/produk/post', [ProductController::class, 'addProduk'])->name('admin.add.produk');
Route::post('/admin/produk/visible/{id}', [ProductController::class, 'visible'])->name('admin.produk.visible');
Route::post('/admin/produk/edit/{id}', [ProductController::class, 'updateProduct'])->name('admin.produk.edit');
Route::post('/admin/produk-kategori/post', [KategoriController::class, 'kategoriPost'])->name('admin.add.kategori');
Route::delete('/admin/produk/delete/{id}', [ProductController::class, 'deleteProduct'])->name('admin.delete.produk');

// Admin POS
Route::get('/admin/pos', [POSController::class, 'index']);
Route::get('/admin/pos/order-summary', [POSController::class, 'orderSummary']);
Route::get('/admin/pos/struk', [POSController::class, 'Struk'])->name('admin.struk');
Route::post('/admin/pos/order', [POSController::class, 'POSAdd'])->name('admin.posAdd');
Route::post('/admin/pos/update-jumlah-produk', [POSController::class, 'updateJumlahProduk'])->name('admin.pos.updateProduk');
Route::post('/admin/pos/order-submit', [POSController::class, 'orderSummarySubmit'])->name('admin.order.submit');
Route::post('/admin/pos/riwayat', [POSController::class, 'riwayat'])->name('admin.order.riwayat');
Route::delete('/admin/pos/delete-produk/{id}', [POSController::class, 'deleteOrder'])->name('admin.deleteOrder');

// Admin - Data Transaksi
Route::get('/admin/data-transaksi', [DataTransaksiController::class, 'index'])->name('admin.data-transaksi');
Route::get('/admin/data-transaksi/detail/{oder_id}', [DataTransaksiController::class, 'detailTransaksi'])->name('admin.data-transaksi.detail');
Route::get('/admin/data-transaksi/detail/{order_id}/export', [DataTransaksiController::class, 'exportExcel'])->name('orders.data-transaksi.detail.export');
Route::delete('/admin/data-transaksi/delete/{order_id}', [DataTransaksiController::class, 'deleteDataTransaksi'])->name('admin.data-transaksi.delete');

// admin logout
Route::post('/admin-logout', [validateForm::class, 'logoutAdmin'])->name('admin.logout');
