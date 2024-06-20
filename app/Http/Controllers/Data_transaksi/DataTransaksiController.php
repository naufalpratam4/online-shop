<?php

namespace App\Http\Controllers\Data_transaksi;

use App\Http\Controllers\Controller;
use App\Models\OrderAdmin;
use Illuminate\Http\Request;

class DataTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = $request->input('per_page', session('per_page', 5)); // Ambil dari request atau session, default 5
        session(['per_page' => $perPage]); // Simpan dalam session

        $transaksi = OrderAdmin::with('product')->where('status', 'Selesai')->paginate($perPage);

        return view('admin.Data-transaksi.index', compact('user', 'transaksi', 'perPage'));
    }
}
