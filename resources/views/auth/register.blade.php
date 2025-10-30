@extends('layouts.app')

@section('content')
<div class="col-md-6 offset-md-3 mt-5">
    <h2 class="fw-bold mb-4 text-center">Register</h2>

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

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="form-control" 
                value="{{ old('name') }}" 
                required
            >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control" 
                value="{{ old('email') }}" 
                required
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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                class="form-control" 
                required
            >
        </div>

        <button type="submit" class="btn btn-success w-100">Register</button>
    </form>

    <p class="text-center mt-3">
        Already have an account?
        <a href="{{ route('login') }}">Login here</a>
    </p>
</div>
@endsection
