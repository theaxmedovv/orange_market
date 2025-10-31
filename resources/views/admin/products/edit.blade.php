@extends('admin.layouts.master')
@section('admin-content')
  <h3 class="fw-bold mb-3">Edit Product</h3>

  <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="card p-3">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Price</label>
      <input name="price" type="number" step="0.01" class="form-control" value="{{ $product->price }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Brand</label>
      <select name="brand_id" class="form-select">
        <option value="">—</option>
        @foreach($brands as $b)<option value="{{ $b->id }}" @if($b->id==$product->brand_id) selected @endif>{{ $b->name }}</option>@endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Category</label>
      <select name="category_id" class="form-select">
        <option value="">—</option>
        @foreach($categories as $c)<option value="{{ $c->id }}" @if($c->id==$product->category_id) selected @endif>{{ $c->name }}</option>@endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Current Image</label><br>
      <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.jpg') }}" width="120" class="mb-2">
      <input name="image" type="file" class="form-control">
    </div>

    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
    </div>

    <button class="btn btn-accent">Update</button>
  </form>
@endsection
