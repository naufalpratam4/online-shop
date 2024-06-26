<?php

namespace App\Http\Controllers\Data_transaksi;

use App\Models\Orders;
use App\Models\Riwayat;
use App\Models\order_item;
use App\Models\OrderAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class DataTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = $request->input('per_page', session('per_page', 5)); // Ambil dari request atau session, default 5
        session(['per_page' => $perPage]); // Simpan dalam session

        // Ambil halaman saat ini
        $page = $request->input('page', 1);

        // Ambil semua data dan kelompokkan
        $riwayatGrouped = Riwayat::with('order')->orderBy('order_id')->get()->groupBy('order_id');

        $riwayatMerged = $riwayatGrouped->map(function ($group) {
            // Proses penggabungan data di sini
            $merged = [
                'id' => $group->first()->id,
                'order_id' => $group->first()->order_id,
                'user_id' => $group->first()->user_id,
                'created_at' => $group->first()->created_at->format('d-m-Y'),
                'total' => $group->first()->order->total,
            ];
            return $merged;
        });

        // Ubah koleksi menjadi array agar bisa di slice untuk paginasi
        $riwayatArray = $riwayatMerged->values()->toArray();

        // Lakukan paginasi manual
        $slice = array_slice($riwayatArray, ($page - 1) * $perPage, $perPage);
        $riwayat = new LengthAwarePaginator($slice, count($riwayatArray), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'query' => $request->query(),
        ]);
        // dd($riwayat);

        // dd($sales);
        return view('admin.Data-transaksi.index', compact('user', 'perPage', 'riwayat'));
    }
    public function detailTransaksi(Request $request, $order_id)
    {
        $user = auth()->user();
        $perPage = $request->input('per_page', session('per_page', 5));
        session(['per_page' => $perPage]); // Simpan dalam session

        $orderItem = order_item::with('product')->where('order_id', $order_id)->paginate($perPage);

        return view('admin.Data-transaksi.detailTransaksi', compact('orderItem', 'user'));
    }

    public function deleteDataTransaksi($order_id)
    {
        // Using where method to get a collection of records
        $dataTransaksi = Riwayat::where('order_id', $order_id)->get();

        if ($dataTransaksi->isNotEmpty()) {
            foreach ($dataTransaksi as $transaksi) {
                $transaksi->delete();
            }
            return redirect()->back()->with('success', 'Berhasil menghapus data transaksi');
        }
        return redirect()->back()->with('error', 'Gagal menghapus data transaksi');
    }
}
