@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4 align-items-center">
        <div class="col-md-6">
            <div class="card border-0 bg-dark shadow-sm">
                <img src="{{ $product->image ?? asset('images/placeholder.jpg') }}" class="img-fluid rounded" alt="{{ $product->name }}">
            </div>
        </div>

        <div class="col-md-6 text-light">
            <h2 class="fw-bold mb-2">{{ $product->name }}</h2>
            <p class="text-muted mb-1">Brand: {{ $product->brand->name ?? 'N/A' }}</p>
            <p class="text-muted mb-1">Category: {{ $product->category->name ?? 'N/A' }}</p>
            <h3 class="text-success mb-3">${{ number_format($product->price, 2) }}</h3>

            <p class="text-secondary mb-4">{{ $product->description }}</p>

            <div class="d-flex gap-3">
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </form>

                <form method="POST" action="{{ route('wishlist.toggle', $product->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-lg">
                        <i class="bi bi-heart"></i> Add to Wishlist
                    </button>
                </form>
            </div>

            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-outline-light">
                    <i class="bi bi-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
