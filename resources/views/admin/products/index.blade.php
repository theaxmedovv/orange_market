@extends('admin.layouts.master')

@section('admin-content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Products</h3>
    <a href="{{ route('admin.products.create') }}" class="btn btn-accent">Add product</a>
  </div>

  <table class="table table-dark table-striped">
    <thead>
      <tr><th>#</th><th>Image</th><th>Name</th><th>Brand</th><th>Price</th><th></th></tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
        <td>{{ $loop->iteration + ($products->currentPage()-1)*$products->perPage() }}</td>
        <td><img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.jpg') }}" width="60"></td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->brand->name ?? '—' }}</td>
        <td>${{ number_format($product->price,2) }}</td>
        <td class="text-end">
          <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
          <form class="d-inline" onsubmit="return confirm('Delete?')" method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $products->links() }}
@endsection
