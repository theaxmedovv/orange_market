<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        // Foydalanuvchining wishlist elementlarini olish
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->with('product') // product bilan birga yuklash
            ->get();

        // View'ga yuborish
        return view('wishlist.index', compact('wishlist'));
    }

    public function toggle($productId)
    {
        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return back()->with('success', 'Product removed from wishlist.');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Product added to wishlist.');
    }
}
