<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function productDetail($id)
    {
        $user = auth()->user();
        $cart = $user ? Cart::where('user_id', $user->id)->first() : '0';
        // dd($cart);
        $cartNotif = $cart ? CartItem::where('cart_id', $cart->id)->count() : '0';

        $produk = Product::find($id);
        // dd($produk);
        return view('user.product.productDetail', compact('cart', 'cartNotif', 'user', 'produk'));
    }
}
