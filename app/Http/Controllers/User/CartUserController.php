<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $order = OrderAdmin::with('product')->where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $product = Product::where('visible', 1)->get();

        // $orders = OrderAdmin::where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $cartNotif = $user ? CartItem::where('cart_id', $user->id)->count() : '0';
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
        $harga = $cartItem->sum('total_harga');
        $biayaAplikasi = 1000;
        $total_jumlah_harga = $harga + $biayaAplikasi;
        // dd($total_jumlah_harga);

        return view('user.cart.cart', compact('user', 'product', 'cart', 'cartItem', 'cartNotif', 'total_jumlah_harga', 'biayaAplikasi'));
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


        return redirect()->back()->with('success', 'Berhasil menambahkan ke keranjang');
    }
    public function POSMin(Request $request)
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
            $cartItem->jumlah -= $request->input('jumlah', 1); // default jumlah to 1 if not provided
            $cartItem->total_harga -= $product->harga;
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


        return redirect()->back()->with('success', 'Berhasil menambahkan ke keranjang');
    }
    public function deleteOrder($id)
    {
        $order = CartItem::find($id);
        $order->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus order');
    }
}
