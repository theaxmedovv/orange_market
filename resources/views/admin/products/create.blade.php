@extends('admin.layouts.master')
@section('admin-content')
  <h3 class="fw-bold mb-3">Create Product</h3>

  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="card p-3">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Price</label>
      <input name="price" type="number" step="0.01" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Brand</label>
      <select name="brand_id" class="form-select">
        <option value="">—</option>
        @foreach($brands as $b)<option value="{{ $b->id }}">{{ $b->name }}</option>@endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select">
        <option value="">—</option>
        @foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      <input name="image" type="file" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <button class="btn btn-accent">Create</button>
  </form>
@endsection
