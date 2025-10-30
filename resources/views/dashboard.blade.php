@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-warning">Admin Dashboard</h1>

    <div class="row g-4">
        <!-- Users Card -->
        <div class="col-md-4">
            <div class="card bg-dark text-light border-secondary shadow h-100">
                <div class="card-body">
                    <h3 class="card-title text-warning"><i class="bi bi-people-fill me-2"></i>Users</h3>
                    <p class="text-secondary mb-4">Manage registered users</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-warning w-100">
                        Manage Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-md-4">
            <div class="card bg-dark text-light border-secondary shadow h-100">
                <div class="card-body">
                    <h3 class="card-title text-warning"><i class="bi bi-box-seam me-2"></i>Products</h3>
                    <p class="text-secondary mb-4">Add, edit, or delete products</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-warning w-100">
                        Manage Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-md-4">
            <div class="card bg-dark text-light border-secondary shadow h-100">
                <div class="card-body">
                    <h3 class="card-title text-warning"><i class="bi bi-receipt me-2"></i>Orders</h3>
                    <p class="text-secondary mb-4">Track and manage orders</p>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-warning w-100">
                        Manage Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
