<?php

namespace App\Http\Controllers\POS;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Riwayat;
use App\Models\CartItem;
use App\Models\order_item;
use App\Models\OrderAdmin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class POSController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $order = OrderAdmin::with('product')->where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $product = Product::where('visible', 1)->get();

        // $orders = OrderAdmin::where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();

        $cart = Cart::where('user_id', $user->id)->first();
        $cartItem = collect();
        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->get();
        }
        if ($cartItem) {
            $total_jumlah_harga = $cartItem->sum('total_harga');
        } else {
            $total_jumlah_harga = 0;
        }


        // return view('admin.POS.POS', compact('user', 'product', 'order', 'total_jumlah_harga', 'orders'));
        return view('admin.POS.POS', compact('user', 'total_jumlah_harga', 'cart', 'product', 'cartItem'));
    }

    public function POSAdd(Request $request)
    {
        $user = auth()->user();
        $product_id = $request->input('product_id');

        // Ambil keranjang belanja untuk pengguna tersebut
        $cart = Cart::where('user_id', $user->id)->first();

        // Jika keranjang tidak ditemukan, buat keranjang baru
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $user->id,
            ]);
        }

        // Ambil produk berdasarkan ID
        $product = Product::where('id', $product_id)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        // Periksa apakah produk sudah ada dalam keranjang belanja
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            // Produk sudah ada dalam keranjang, perbarui jumlah
            $cartItem->jumlah += $request->input('jumlah', 1); // default jumlah to 1 if not provided
            $cartItem->total_harga += $product->harga;
            $cartItem->updated_at = now();
            $cartItem->save();
        } else {
            // Produk belum ada dalam keranjang, tambahkan produk baru
            $data = [
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'jumlah' => $request->input('jumlah', 1), // default jumlah to 1 if not provided
                'total_harga' => $product->harga * $request->input('jumlah', 1),
            ];
            // Buat item keranjang baru
            CartItem::create($data);
        }


        return redirect()->back()->with('success', 'Berhasil menambahkan produk');
    }
    public function UpdateJumlahProduk(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();

        $product_id = $request->input('product_id');
        $jumlah = $request->input('jumlah');

        // cek product
        $product = Product::where('id', $product_id)->first();
        // dd($product);

        // Cari produk berdasarkan product_id
        $cartItem = CartItem::where('product_id', $product_id)->where('cart_id', $cart->id)
            ->first();
        // untuk menjumlah harga produk
        $total_jumlah_harga =   $product->harga * $jumlah;

        if ($jumlah > $product->stock) {
            return redirect()->back()->with('error', "Stok habis/tersisa {$product->stock} stok");
        }


        if ($cartItem) {
            $cartItem->update(['jumlah' => $jumlah, 'total_harga' => $total_jumlah_harga]);
            return redirect()->back()->with('success', 'Berhasil memperbarui jumlah produk');
        } else {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
    }
    public function deleteOrder($id)
    {
        $order = CartItem::find($id);
        $order->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus order');
    }

    public function orderSummary()
    {
        $user = auth()->user();

        $cart = Cart::where('user_id', $user->id)->first();

        $cartItem = collect();
        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)->get();
        }

        $total_jumlah_harga = $cartItem->sum('total_harga');

        return view('admin.POS.OrderSummary', compact('user', 'cart', 'cartItem', 'total_jumlah_harga'));
    }

    public function orderSummarySubmit(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItem = CartItem::where('cart_id', $cart->id)->get();
        if (!$cartItem) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }
        $total_jumlah_harga = $cartItem->sum('total_harga');
        // dd($total_jumlah_harga);

        $today = Carbon::now();
        $date = $today->format('dmY');

        // Untuk mengetahui order terakhir pada hari ini
        $lastOrder = Orders::whereDate('created_at', $today->toDateString())
            ->orderBy('created_at', 'desc')
            ->first();

        // Jika belum ada order hari ini, mulai dari 1
        if (!$lastOrder) {
            $orderNumber = 1;
        } else {
            // Jika sudah ada, tambah 1 dari nomor urut terakhir
            $lastOrderNumber = (int)substr($lastOrder->nomor_order, -4);
            $orderNumber = $lastOrderNumber + 1;
        }

        // Format nomor pesanan
        $formattedOrderNumber = sprintf('AdminDK-%s-%04d', $date, $orderNumber);

        // Membuat order baru
        $order = Orders::create([
            'user_id' => auth()->id(),
            'total' => $total_jumlah_harga,
            'status' => 'pending',
            'nomor_order' => $formattedOrderNumber
        ]);

        $jumlah_product = $cartItem->sum('jumlah');

        foreach ($cartItem as $item) {
            order_item::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->jumlah,
                'price' => $item->total_harga
            ]);

            // Update product quantity
            $product = Product::where('id', $item->product_id)->first();
            $product->stock -= $item->jumlah;
            $product->save();
        }


        $hapusCart = CartItem::where('cart_id', $cart->id);
        $hapusCart->delete();
        // Redirect dengan pesan sukses
        return redirect('/admin/pos/struk')->with('success', 'Transaksi berhasil');
    }


    public function Struk()
    {
        $user = auth()->user();

        $cart = Orders::where('user_id', $user->id)->latest()->first();

        $cartItem = order_item::with('product')->where('order_id', $cart->id)->get();
        // dd($cartItem);
        $total_jumlah_harga = $cartItem->sum('price');

        return view('admin.POS.Struk', compact('total_jumlah_harga', 'cart', 'cartItem'));
    }
    public function riwayat()
    {
        $user = auth()->user();
        $orders = Orders::where('user_id', $user->id)->get();

        foreach ($orders as $order) {
            Riwayat::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'action' => 'Order added to history',
            ]);
            Orders::where('user_id', $user->id)->update(['status' => 'Berhasil']);
        }

        return redirect('/admin/pos')->with('success', 'Berhasil menambahkan ke riwayat');
    }
}
