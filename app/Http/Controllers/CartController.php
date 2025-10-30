<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = CartItem::where('user_id', Auth::id())
            ->with('product.brand')
            ->get();

        return view('cart.index', compact('items'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = Auth::user();
        $qty = $request->input('quantity', 1);

        $item = CartItem::firstOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id],
            ['quantity' => 0, 'added_at' => now()]
        );

        $item->quantity += $qty;
        $item->added_at = now();
        $item->save();

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function remove($id)
    {
        $item = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function checkout()
    {
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('home')->with('success', 'Purchase completed (simulated).');
    }
}
