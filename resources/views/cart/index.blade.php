@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold mb-4">Your Cart</h1>

    @if($items->count() > 0)
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th width="100">Price</th>
                    <th width="100">Qty</th>
                    <th width="100">Total</th>
                    <th width="100">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach($items as $item)
                    @php 
                        $subtotal = $item->product->price * $item->quantity;
                        $grandTotal += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            <strong>{{ $item->product->name }}</strong><br>
                            <small class="text-muted">{{ $item->product->brand->name ?? '' }}</small>
                        </td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($subtotal, 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end mt-3">
            <h5>Total: <strong>${{ number_format($grandTotal, 2) }}</strong></h5>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-2">Continue Shopping</a>
            <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-success mt-2">Checkout</button>
            </form>
        </div>
    @else
        <div class="alert alert-info">Your cart is empty.</div>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Go Shopping</a>
    @endif
</div>
@endsection
