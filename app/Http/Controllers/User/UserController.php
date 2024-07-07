<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CartItem;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $produk = Product::where('visible', 1)->get();
        $cartNotif = $user ? CartItem::where('cart_id', $user->id)->count() : '0';
        // dd($cart);
        return view('user.landingpage', compact('produk', 'cartNotif', 'user'));
    }
    public function userDetail()
    {
        $user = auth()->user();
        $cartNotif = $user ? CartItem::where('cart_id', $user->id)->count() : '0';
        return view('user.profile.userProfile', compact('user', 'cartNotif'));
    }
    public function myOrder()
    {
        $user = auth()->user();
        $cartNotif = $user ? CartItem::where('cart_id', $user->id)->count() : '0';
        return view('user.myorder.myorder', compact('user', 'cartNotif'));
    }
}
