@extends('layouts.app')
@section('title','All Products')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Products</h2>
    <div>
      <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
    </div>
  </div>

  <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($products as $product)
      <div class="col">
        <div class="card h-100">
          <a href="{{ route('products.show', $product->id) }}">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.jpg') }}"
                 class="card-img-top product-img p-3" alt="{{ $product->name }}">
          </a>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="text-muted mb-2 small">{{ $product->brand->name ?? 'No Brand' }}</p>
            <div class="mt-auto d-flex justify-content-between align-items-center">
              <div class="fw-bold text-success">${{ number_format($product->price, 2) }}</div>
              <a class="btn btn-sm btn-outline-light" href="{{ route('products.show', $product->id) }}"><i class="bi bi-eye"></i></a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info">No products found.</div>
      </div>
    @endforelse
  </div>

  <div class="mt-4 d-flex justify-content-center">
    {{ $products->appends(request()->query())->links() }}
  </div>
</div>
@endsection
