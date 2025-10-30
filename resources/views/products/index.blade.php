@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-light text-center">All Products</h1>

    <div class="mb-4">
        <form action="{{ route('products.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-secondary border-secondary text-light">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control" placeholder="Search products..."
                           value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-3">
                <select name="brand" class="form-select">
                    <option value="">All Brands</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->slug }}" {{ request('brand') == $brand->slug ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <button class="btn btn-warning w-100">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($products as $product)
            <div class="col">
                <div class="card h-100 bg-dark text-light border-secondary shadow">
                    <img src="{{ $product->image ?? asset('images/placeholder.jpg') }}" class="card-img-top p-3" alt="{{ $product->name }}" style="max-height: 250px; object-fit: contain;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-warning fw-semibold mb-2">{{ $product->brand->name ?? 'No Brand' }}</p>
                        <p class="text-success fs-5 fw-bold mb-3">${{ number_format($product->price, 2) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-heart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info bg-secondary text-white border-0 text-center">
                    <i class="bi bi-info-circle me-2"></i>No products found.
                </div>
            </div>
        @endforelse
    </div>

    @if($products->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
