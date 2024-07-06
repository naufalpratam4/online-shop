<?php

use App\Http\Controllers\auth\validateForm;
use App\Http\Controllers\Dasboard\DashboardController;
use App\Http\Controllers\Data_transaksi\DataTransaksiController;
use App\Http\Controllers\Jastip\JastipController;
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

// Route untuk login admin
Route::post('/login-admin', [ValidateForm::class, 'loginAdmin'])->name('login.admin');
Route::get('/register-admin', function () {
    return view('admin.auth.registerUser');
})->name('register.admin');
Route::post('/register-admin', [ValidateForm::class, 'registerAdmin'])->name('register.admin');


Route::prefix('admin')->group(function () {
    Route::middleware(['Admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Admin produk
        Route::get('produk', [ProductController::class, 'index']);
        Route::get('produk/{nama_produk}', [ProductController::class, 'productId'])->name('admin.productId');
        Route::post('produk/post', [ProductController::class, 'addProduk'])->name('admin.add.produk');
        Route::post('produk/visible/{id}', [ProductController::class, 'visible'])->name('admin.produk.visible');
        Route::post('produk/edit/{id}', [ProductController::class, 'updateProduct'])->name('admin.produk.edit');
        Route::post('produk-kategori/post', [KategoriController::class, 'kategoriPost'])->name('admin.add.kategori');
        Route::delete('produk/delete/{id}', [ProductController::class, 'deleteProduct'])->name('admin.delete.produk');

        // Admin POS
        Route::get('pos', [POSController::class, 'index']);
        Route::get('pos/order-summary', [POSController::class, 'orderSummary']);
        Route::get('pos/struk', [POSController::class, 'Struk'])->name('admin.struk');
        Route::post('pos/order', [POSController::class, 'POSAdd'])->name('admin.posAdd');

        Route::post('pos/update-jumlah-produk', [POSController::class, 'updateJumlahProduk'])->name('admin.pos.updateProduk');
        Route::post('pos/order-submit', [POSController::class, 'orderSummarySubmit'])->name('admin.order.submit');
        Route::post('pos/riwayat', [POSController::class, 'riwayat'])->name('admin.order.riwayat');
        Route::delete('pos/delete-produk/{id}', [POSController::class, 'deleteOrder'])->name('admin.deleteOrder');

        // Admin Jastip
        Route::get('jastip', [JastipController::class, 'index'])->name('admin.jastip.index');

        Route::post('jastip/addPesanan', [JastipController::class, 'addPesanan'])->name('admin.jastip.addPesanan');
        Route::post('jastip/visible/{id}', [JastipController::class, 'visible'])->name('admin.jastip.visible');
        Route::post('jastip/editPesanan/{id}', [JastipController::class, 'editPesanan'])->name('admin.jastip.editPesanan');
        Route::delete('jastip/delete/{id}', [JastipController::class, 'deletePesanan'])->name('admin.jastip.deletePesanan');


        // Admin - Data Transaksi
        Route::get('data-transaksi', [DataTransaksiController::class, 'index'])->name('admin.data-transaksi');
        Route::get('data-transaksi/detail/{oder_id}', [DataTransaksiController::class, 'detailTransaksi'])->name('admin.data-transaksi.detail');
        Route::get('data-transaksi/detail/{order_id}/export', [DataTransaksiController::class, 'exportExcel'])->name('orders.data-transaksi.detail.export');
        Route::delete('data-transaksi/delete/{order_id}', [DataTransaksiController::class, 'deleteDataTransaksi'])->name('admin.data-transaksi.delete');
        Route::get('data-transaksi/export-excel', [DataTransaksiController::class, 'downloadTransaksi'])->name('admin.transaksi.export');
        // admin logout
        Route::post('/admin-logout', [validateForm::class, 'logoutAdmin'])->name('admin.logout');
    });
});
