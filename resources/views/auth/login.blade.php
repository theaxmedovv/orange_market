@extends('layouts.app')
@section('title','Login')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h3 class="mb-3 fw-bold text-center">Sign in to apelsin.</h3>

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email') }}" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <button class="btn btn-accent w-100">Login</button>
        </form>

        <p class="text-center mt-3 small">Don't have an account? <a href="{{ route('register') }}" class="text-accent">Register</a></p>
      </div>
    </div>
  </div>
</div>
@endsection
