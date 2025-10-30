@extends('layouts.app')

@section('content')
<div class="col-md-6 offset-md-3 mt-5">
    <h2 class="fw-bold mb-4 text-center">Login</h2>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control" 
                value="{{ old('email') }}" 
                required 
                autofocus
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control" 
                required
            >
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>

    <p class="text-center mt-3">
        Don’t have an account? 
        <a href="{{ route('register') }}">Register here</a>
    </p>
</div>
@endsection
