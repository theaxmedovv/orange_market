@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center text-light">Your Wishlist</h1>

    @if($wishlist->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($wishlist as $item)
                <div class="col">
                    <div class="card h-100 bg-dark text-light border-secondary shadow-sm">
                        <img src="{{ $item->product->image ?? asset('images/placeholder.jpg') }}" 
                             class="card-img-top p-3" 
                             alt="{{ $item->product->name }}" 
                             style="max-height: 250px; object-fit: contain;">

                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="text-success fs-5 fw-bold mb-3">
                                ${{ number_format($item->product->price, 2) }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('products.show', $item->product->id) }}" 
                                   class="btn btn-outline-light btn-sm w-100 mb-2">
                                    <i class="bi bi-eye"></i> View
                                </a>

                                <form method="POST" action="{{ route('cart.add', $item->product->id) }}" class="mb-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('wishlist.remove', $item->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="bi bi-x"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center bg-secondary border-0 text-light mt-4">
            <i class="bi bi-heartbreak me-2"></i>You have no items in your wishlist.
        </div>
    @endif
</div>
@endsection
