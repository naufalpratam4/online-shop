<?php

namespace App\Http\Controllers\Dasboard;

use App\Http\Controllers\Controller;
use App\Models\order_item;
use App\Models\OrderAdmin;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        // Inisialisasi variabel untuk menyimpan hasil per bulan
        $customersPerMonth = [];

        // Inisialisasi array untuk menyimpan hasil per bulan
        $totalHargaPerMonth = [];

        // Loop untuk bulan Januari (bulan ke-1) hingga Desember (bulan ke-12)
        for ($month = 1; $month <= 12; $month++) {
            // Query untuk mengambil order berdasarkan bulan
            $orderPerMonth = order_item::whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->get();

            // Menghitung total jumlah harga per bulan
            $total_jumlah_harga = $orderPerMonth->sum('price');

            // Simpan hasil dalam array dengan key berdasarkan nama bulan (opsional)
            $monthName = date('M', mktime(0, 0, 0, $month, 1));
            $totalHargaPerMonth[$monthName] = $total_jumlah_harga;
        }


        // Loop untuk bulan Januari (bulan ke-1) hingga Desember (bulan ke-12)
        for ($month = 1; $month <= 12; $month++) {
            // Query untuk menghitung jumlah order per bulan
            $count = order_item::whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->count();

            // Simpan hasil dalam array dengan key berdasarkan nama bulan (opsional)
            $monthName = date('M', mktime(0, 0, 0, $month, 1));
            $customersPerMonth[$monthName] = $count;
        }

        if ($request->is('api/*') || $request->wantsJson()) {
            return response()->json(['customers_per_month' => $customersPerMonth]);
        } else {
            // Jika request adalah web view
            return view('admin.dashboard.index', compact('user', 'customersPerMonth', 'totalHargaPerMonth'));
        }
    }
}
