<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CartUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $order = OrderAdmin::with('product')->where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $product = Product::where('visible', 1)->get();

        // $orders = OrderAdmin::where('admin_id', $user->id)->where('status', 'Belum Selesai')->get();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartNotif = $user ? CartItem::where('cart_id', $cart->id)->count() : '0';
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
            $newJumlah = $cartItem->jumlah - $request->input('jumlah', 1); // default jumlah to 1 if not provided
            $newTotalHarga = $newJumlah * $product->harga;

            if ($newJumlah < 0 || $newTotalHarga < 0) {
                return redirect()->back()->withErrors(['error' => 'Jumlah tidak boleh kurang dari 0']);
            }

            $cartItem->jumlah = $newJumlah;
            $cartItem->total_harga = $newTotalHarga;
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

            if ($data['jumlah'] < 0 || $data['total_harga'] < 0) {
                return redirect()->back()->withErrors(['error' => 'Jumlah atau total harga tidak boleh kurang dari 0']);
            }

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

    public function order()
    {
        $user = auth()->user();

        $cartId = Cart::where('user_id', $user->id)->first();
        $cartItem = CartItem::with('product')->where('cart_id', $cartId->id)->get();
        $harga = $cartItem->sum('total_harga');
        $biayaAplikasi = 1000;
        $total_jumlah_harga = $harga + $biayaAplikasi;
        // dd($total_jumlah_harga);

        // dd($cartItem);
        return view('user.cart.order', compact('user', 'cartItem', 'total_jumlah_harga', 'biayaAplikasi'));
    }
    public function checkout(Request $request)
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$user->alamat) {
            return redirect('/user-detail')->with('error', 'Alamat belum tersedia, harap mengisi alamat anda');
        }
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }
        $biayaAplikasi = 1000;

        $total_jumlah_harga = $biayaAplikasi + $cartItems->sum('total_harga');

        $today = Carbon::now();
        $date = $today->format('Ymd');

        // Mengambil nomor urut terakhir untuk hari ini
        $lastOrder = Orders::whereDate('created_at', $today->toDateString())
            ->orderBy('created_at', 'desc')
            ->first();

        // Jika belum ada order hari ini, mulai dari 1
        if (!$lastOrder) {
            $orderNumber = 1;
        } else {
            // Jika sudah ada, tambah 1 dari nomor urut terakhir
            $lastOrderNumber = substr($lastOrder->nomor_order, -4);
            $orderNumber = (int)$lastOrderNumber + 1;
        }

        // Buat nomor order baru
        $formattedOrderNumber = sprintf('ORD-%s-%04d', $date, $orderNumber);

        DB::beginTransaction();

        try {
            // Membuat order baru
            $order = Orders::create([
                'user_id' => $user->id,
                'total' => $total_jumlah_harga,
                'status' => 'pending',
                'nomor_order' => $formattedOrderNumber
            ]);

            foreach ($cartItems as $item) {
                order_item::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->jumlah,
                    'price' => $item->total_harga
                ]);

                // Update product quantity
                $product = Product::where('id', $item->product_id)->first();
                if ($product) {
                    $product->stock -= $item->jumlah;
                    $product->save();
                }
            }

            // Hapus cart items setelah checkout
            CartItem::where('cart_id', $cart->id)->delete();

            DB::commit();

            return redirect('/')->with('success', 'Sukses order');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Checkout failed', 'error' => $e->getMessage()], 500);
        }
    }
}
