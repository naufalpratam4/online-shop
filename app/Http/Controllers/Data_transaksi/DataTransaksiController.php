<?php

namespace App\Http\Controllers\Data_transaksi;

use App\Http\Controllers\Controller;
use App\Models\OrderAdmin;
use Illuminate\Http\Request;

class DataTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = OrderAdmin::with('product')->where('status', 'Selesai')->get();

        return view('admin.Data-transaksi.index', compact('transaksi'));
    }
}
