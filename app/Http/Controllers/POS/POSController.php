<?php

namespace App\Http\Controllers\POS;

use App\Models\Product;
use App\Models\Riwayat;
use App\Models\OrderAdmin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class POSController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $order = OrderAdmin::with('product')->where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $product = Product::where('visible', 1)->get();

        $orders = OrderAdmin::where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();

        if ($order) {
            $total_jumlah_harga = $orders->sum('total_harga');
        } else {
            $total_jumlah_harga = 0;
        }

        return view('admin.POS.POS', compact('user', 'product', 'order', 'total_jumlah_harga', 'orders'));
    }

    public function POSAdd(Request $request)
    {
        $user = auth()->user();
        $product_id = $request->input('product_id');
        $product = Product::where('id', $product_id)->first();
        // Cari order berdasarkan admin_id dan product_id
        // Tentukan nilai randomNumber terlebih dahulu
        $randomNumber = mt_rand(100000, 999999);

        $order = OrderAdmin::where('admin_id', $user->id)
            ->where('status', 'Belum Selesai')
            ->where('product_id', $product_id)
            ->first();

        if ($order) {
            // Jika order sudah ada, tambahkan jumlah dengan 1
            $order->jumlah += 1;
            $order->total_harga += $product->harga;
            $order->tanggal = now(); // Ubah tanggal jika perlu
            $order->save();
        } else {
            // Jika order belum ada, buat data baru
            $data = [
                'no_transaksi' =>  $randomNumber,
                'admin_id' => $user->id,
                'product_id' => $product_id,
                'jumlah' => 1,
                'total_harga' => $product->harga,
                'tanggal' => now(),
                'status' => 'Belum Selesai',
                // 'created_at' => now() // Tidak perlu ditetapkan secara manual
            ];
            OrderAdmin::create($data);
        }




        return redirect()->back()->with('success', 'Berhasil menambahkan produk');
    }
    public function UpdateJumlahProduk(Request $request)
    {
        $user = auth()->user();

        $product_id = $request->input('product_id');
        $jumlah = $request->input('jumlah');

        $product = Product::where('id', $product_id)->first();
        // Cari produk berdasarkan product_id
        $order = OrderAdmin::where('admin_id', $user->id)
            ->where('status', 'Belum Selesai')
            ->where('product_id', $product_id)
            ->first();
        $total_jumlah_harga =   $product->harga * $jumlah;


        if ($order) {
            $order->update(['jumlah' => $jumlah, 'total_harga' => $total_jumlah_harga]);
            return redirect()->back()->with('success', 'Berhasil memperbarui jumlah produk');
        } else {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
    }
    public function deleteOrder($id)
    {
        $order = OrderAdmin::find($id);
        $order->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus order');
    }

    public function orderSummary()
    {
        $user = auth()->user();

        $order = OrderAdmin::with('product')->where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $total_jumlah_harga = $order->sum('total_harga');

        return view('admin.POS.OrderSummary', compact('user', 'order', 'total_jumlah_harga'));
    }
    public function orderSummarySubmit(Request $request)
    {
        $user = auth()->user();
        $orders = $request->input('id'); // Mengambil semua id dari form

        foreach ($orders as $order_id) {
            $new_status = $request->input('status.' . $order_id); // Mengambil status sesuai dengan id

            // Simpan riwayat
            Riwayat::create(['order_id' => $order_id]);

            // Update status di tabel order_admins berdasarkan order_id
            OrderAdmin::where('id', $order_id)
                ->where('status', 'Belum Selesai')
                ->update(['status' => $new_status]);
        }

        // Redirect dengan pesan sukses
        return redirect('/admin/pos')->with('success', 'Transaksi berhasil');
    }


    public function Struk()
    {
        $user = auth()->user();
        $order = OrderAdmin::with('product')->where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $total_jumlah_harga = $order->sum('total_harga');
        $struk = OrderAdmin::where('status', 'Belum Selesai')->get();
        return view('admin.POS.Struk', compact('struk', 'total_jumlah_harga'));
    }
}
