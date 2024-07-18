<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\order_item;
use App\Models\Orders;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $produk = Product::where('visible', 1)->get();
        $cart = $user ? Cart::where('user_id', $user->id)->first() : '0';
        // dd($cart);
        $cartNotif = $cart ? CartItem::where('cart_id', $cart->id)->count() : '0';

        // dd($user);
        // dd($cart);
        return view('user.landingpage', compact('produk', 'cartNotif', 'user'));
    }
    public function userDetail()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first();
        // dd($cart);
        $cartNotif = $user ? CartItem::where('cart_id', $cart->id)->count() : '0';
        return view('user.profile.userProfile', compact('user', 'cartNotif'));
    }
    public function myOrder()
    {
        $user = auth()->user();
        $cart = Cart::where('user_id', $user->id)->first(); // Ambil keranjang yang terkait dengan pengguna ini
        $order = Orders::where('user_id', $user->id)->get(); // Ambil semua pesanan untuk pengguna ini

        // Ambil detail item untuk setiap pesanan
        foreach ($order as $item) {
            $item->orderItems = order_item::where('order_id', $item->id)->get();

            // Ambil nama produk untuk setiap OrderItem
            foreach ($item->orderItems as $orderItem) {
                $namaProduk = $orderItem->product->nama; // Sesuaikan 'nama' dengan nama kolom yang menyimpan nama produk
                // Lakukan apa pun yang perlu Anda lakukan dengan $namaProduk
            }
        }

        $cartNotif = $user ? CartItem::where('cart_id', $cart->id)->count() : '0';

        return view('user.myorder.myorder', compact('user', 'cartNotif', 'order'));
    }
}
