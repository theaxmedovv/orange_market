<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the authenticated user's wishlist.
     * 
     * GET /wishlist
     */
    public function index()
    {
        $items = Wishlist::where('user_id', Auth::id())
            ->with(['product.brand', 'product.category'])
            ->get();

        return view('wishlist.index', compact('items'));
    }

    /**
     * Toggle a product in the wishlist (add/remove).
     * 
     * POST /wishlist/{product}
     * 
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(Product $product)
    {
        $userId = Auth::id();

        $existing = Wishlist::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['added' => false, 'message' => 'Removed from wishlist']);
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $product->id,
        ]);

        return response()->json(['added' => true, 'message' => 'Added to wishlist']);
    }
}
