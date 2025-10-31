@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="container py-5">
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card p-3">
        <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.jpg') }}"
             class="img-fluid" alt="{{ $product->name }}">
      </div>
    </div>
    <div class="col-md-6">
      <h2 class="fw-bold">{{ $product->name }}</h2>
      <p class="text-muted mb-1">Brand: {{ $product->brand->name ?? 'N/A' }}</p>
      <h3 class="text-success mb-3">${{ number_format($product->price, 2) }}</h3>
      <p class="text-muted">{{ $product->description }}</p>

      <div class="mt-4 d-flex gap-2">
        <form method="POST" action="{{ route('cart.add', $product->id) }}">
          @csrf
          <button class="btn btn-accent"><i class="bi bi-cart-plus"></i> Add to Cart</button>
        </form>

        <form method="POST" action="{{ route('wishlist.toggle', $product->id) }}">
          @csrf
          <button class="btn btn-outline-light"><i class="bi bi-heart"></i> Wishlist</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
