<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\validateForm;
use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\ProductController as AdminProductController;
use App\Http\Controllers\KategoriController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Jastip\JastipController;
use App\Http\Controllers\Dasboard\DashboardController;
use App\Http\Controllers\Data_transaksi\DataTransaksiController;
use App\Http\Controllers\PesananOnline\PesananOnlineController;
use App\Http\Controllers\User\CartUserController;
use App\Http\Controllers\User\EditUserDetailController;
use App\Http\Controllers\User\ReviewController;

Route::get('/', [UserController::class, 'index']);

Route::get('/product-detail/{id}', [ProductController::class, 'productDetail'])->name('product.detail');

Route::get('/login', function () {
    return view('user.auth.loginUser');
});
Route::get('/register', function () {
    return view('user.auth.registerUser');
});
Route::post('/login', [validateForm::class, 'login'])->name('login.user');
Route::post('/register', [validateForm::class, 'registerUser'])->name('register.user');


// User after login
Route::middleware(['User'])->group(function () {
    Route::get('/cart', [CartUserController::class, 'index']);
    Route::get('/order', [CartUserController::class, 'order'])->name('user.order');

    // user detail
    Route::get('/user-detail', [UserController::class, 'userDetail']);
    Route::post('/user-detail/name', [EditUserDetailController::class, 'Name'])->name('user.edit.name');
    Route::post('/user-detail/tgl_lahir', [EditUserDetailController::class, 'tgl_lahir'])->name('user.edit.tgl');
    Route::post('/user-detail/email', [EditUserDetailController::class, 'email'])->name('user.edit.email');
    Route::post('/user-detail/no_hp', [EditUserDetailController::class, 'no_hp'])->name('user.edit.no_hp');
    Route::post('/user-detail/jenis_kelamin', [EditUserDetailController::class, 'jenis_kelamin'])->name('user.edit.jenis_kelamin');
    Route::post('/user-detail/alamat', [EditUserDetailController::class, 'Alamat'])->name('user.edit.alamat');
    // end user detail
    Route::get('/myorder', [UserController::class, 'myOrder']);

    // review
    Route::post('/review', [ReviewController::class, 'review'])->name('review');

    Route::post('/order', [CartUserController::class, 'POSAdd'])->name('user.posAdd');
    Route::post('/order-min', [CartUserController::class, 'POSMin'])->name('user.posMin');
    Route::post('/order/checkout', [CartUserController::class, 'checkout'])->name('user.order.checkout');
    Route::delete('/order/delete/{id}', [CartUserController::class, 'deleteOrder'])->name('order.delete');
    Route::post('/logout', [validateForm::class, 'logoutUser'])->name('user.logout');
});

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
        Route::get('produk', [AdminProductController::class, 'index']);
        Route::get('produk/{nama_produk}', [AdminProductController::class, 'productId'])->name('admin.productId');
        Route::post('produk/post', [AdminProductController::class, 'addProduk'])->name('admin.add.produk');
        Route::post('produk/visible/{id}', [AdminProductController::class, 'visible'])->name('admin.produk.visible');
        Route::post('produk/edit/{id}', [AdminProductController::class, 'updateProduct'])->name('admin.produk.edit');
        Route::post('produk-kategori/post', [KategoriController::class, 'kategoriPost'])->name('admin.add.kategori');
        Route::delete('produk/delete/{id}', [AdminProductController::class, 'deleteProduct'])->name('admin.delete.produk');

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

        // Admin - Pesanan Online
        Route::get('pesanan-online', [PesananOnlineController::class, 'index'])->name('admin.pesanan-online');
        // admin logout
        Route::post('/admin-logout', [validateForm::class, 'logoutAdmin'])->name('admin.logout');
    });
});
