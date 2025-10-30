<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Product::query()->with(['brand', 'category']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('brand')) {
            $query->whereHas('brand', fn($q) => $q->where('slug', $request->brand));
        }

        $products = $query->latest()->paginate(18)->withQueryString();

        $categories = Category::select('name', 'slug')->get();
        $brands = Brand::select('name', 'slug')->get();

        $selectedBrand = $request->brand ? Brand::where('slug', $request->brand)->first() : null;
        $selectedCategory = $request->category ? Category::where('slug', $request->category)->first() : null;

        return view('products.index', compact(
            'products', 'categories', 'brands', 'selectedBrand', 'selectedCategory'
        ));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function store(Request $request) { /* ... */ }
    public function update(Request $request, Product $product) { /* ... */ }
    public function destroy(Product $product) { /* ... */ }
}
