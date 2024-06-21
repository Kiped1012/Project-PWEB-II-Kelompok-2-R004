<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function view()
    {
        $user = Auth::user();

        if ($user) {
            $wishlistCount = Wishlist::where('user_id', $user->id)->count();
            $wishlistItems = Wishlist::where('user_id', $user->id)->with('produk')->get();
            $keranjangItems = Keranjang::where('user_id', $user->id)->with('produk')->get();

            return view('home.index', [
                'wishlistCount' => $wishlistCount,
                'wishlistItems' => $wishlistItems,
                'keranjangItems' => $keranjangItems,
            ]);
        } else {
            return view('home.index', [
                'wishlistCount' => 'Anda belum login, klik login',
                'wishlistItems' => [],
                'keranjangItems' => [],
            ]);
        }
    }
}
