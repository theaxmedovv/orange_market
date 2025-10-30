@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('images/orange.jpg') }}" alt="Apelsin logo" style="width: 30px; border-radius: 50%;">
            <span class="fw-bold fs-3" style="color: #fbbf24;">apelsin<span style="color: #f59e0b;">.</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            @php
                $isShopActive = request()->routeIs('categories.index') || request()->routeIs('brands.index');
            @endphp
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-1"></i>Home
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ $isShopActive ? 'active' : '' }}" href="#" id="shopDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-shop me-1"></i>Shop
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item {{ request()->routeIs('categories.index') ? 'active' : '' }}" href="{{ route('categories.index') }}"><i class="bi bi-tags me-2"></i>By Category</a></li>
                        <li><a class="dropdown-item {{ request()->routeIs('brands.index') ? 'active' : '' }}" href="{{ route('brands.index') }}"><i class="bi bi-award me-2"></i>By Brand</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                @auth
                    <li class="nav-item"><a class="nav-link" href="{{ route('wishlist.index') }}" title="Wishlist"><i class="bi bi-heart fs-5"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}" title="Cart"><i class="bi bi-cart3 fs-5"></i></a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5 me-2"></i>
                            <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li class="dropdown-item-text">
                                <strong>{{ Auth::user()->name }}</strong><br>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-lines-fill me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-seam me-2"></i>Orders</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-warning ms-2" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    {{-- Filters --}}
    <div class="filter-bar bg-dark text-light p-3 rounded-3 mb-4 shadow-lg border border-secondary">
        <form action="{{ route('home') }}" method="GET">
            <div class="row g-3 align-items-center">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-secondary border-secondary text-light"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" name="search" placeholder="Search products..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="brand" class="form-select">
                        <option value="">Brand</option>
                        @foreach ($brands ?? [] as $brand)
                            <option value="{{ $brand->slug }}" {{ request('brand') == $brand->slug ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">Category</option>
                        @foreach ($categories ?? [] as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-warning"><i class="bi bi-funnel me-1"></i>Apply</button>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary ms-2"><i class="bi bi-x-circle me-1"></i>Clear</a>
                </div>
            </div>
        </form>
    </div>

    {{-- Product Grid --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($products ?? [] as $product)
            <div class="col">
                <div class="card h-100 bg-dark text-light border-secondary shadow">
                    <img src="{{ $product->image_url ?? asset('images/placeholder.jpg') }}" class="card-img-top p-3" style="max-height: 250px; object-fit: contain;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-warning fw-semibold">{{ $product->brand->name ?? 'No Brand' }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <p class="fs-4 fw-bold mb-0 text-success">${{ number_format($product->price, 0, '.', ',') }}</p>
                            <div>
                                <button class="btn btn-outline-warning btn-sm me-2" title="Add to Wishlist"><i class="bi bi-heart"></i></button>
                                <button class="btn btn-warning btn-sm" title="Add to Cart"><i class="bi bi-cart-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info bg-secondary text-white border-0">
                    <i class="bi bi-info-circle me-2"></i>No products found matching your filters.
                </div>
            </div>
        @endforelse
    </div>

    @if(isset($products) && $products->hasPages())
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @endif
</div>

@endsection
