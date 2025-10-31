@extends('admin.layouts.master')

@section('admin-content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Dashboard</h2>
    <div>
      <a href="{{ route('admin.products.create') }}" class="btn btn-accent">New Product</a>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Products</h5>
        <p class="display-6">{{ \App\Models\Product::count() }}</p>
        <a href="{{ route('admin.products.index') }}" class="small">Manage products →</a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-3">
        <h5>Users</h5>
        <p class="display-6">{{ \App\Models\User::count() }}</p>
        <a href="{{ route('admin.users.index') }}" class="small">Manage users →</a>
      </div>
    </div>
  </div>
@endsection
