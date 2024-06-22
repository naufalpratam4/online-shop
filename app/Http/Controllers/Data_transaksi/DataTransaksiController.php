<?php

namespace App\Http\Controllers\Data_transaksi;

use App\Http\Controllers\Controller;
use App\Models\order_item;
use App\Models\OrderAdmin;
use App\Models\Orders;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class DataTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = $request->input('per_page', session('per_page', 5)); // Ambil dari request atau session, default 5
        session(['per_page' => $perPage]); // Simpan dalam session


        $sales = order_item::with('order')->paginate($perPage);

        // dd($sales);
        return view('admin.Data-transaksi.index', compact('user', 'perPage', 'sales'));
    }
}
