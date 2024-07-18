<?php

namespace App\Http\Controllers\PesananOnline;

use App\Models\User;
use App\Models\Orders;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class PesananOnlineController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $perPage = $request->input('per_page', session('per_page', 5)); // Ambil dari request atau session, default 5
        session(['per_page' => $perPage]); // Simpan dalam session

        // Ambil halaman saat ini
        $page = $request->input('page', 1);

        // Ambil semua pengguna dengan peran 'User'
        $users = User::where('role', 'User')->get();

        // Ambil semua ID pengguna dengan peran 'User'
        $userIds = $users->pluck('id');

        // Ambil semua riwayat pesanan dari pengguna yang memiliki peran 'User'
        $riwayat = Orders::with('user')
            ->whereIn('user_id', $userIds)
            ->orderBy('user_id')
            ->get();

        // dd($riwayat);
        return view('admin.pesanan-online.index', compact('user', 'riwayat'));
    }
}
