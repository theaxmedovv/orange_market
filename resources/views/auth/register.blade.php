@extends('layouts.app')
@section('title','Register')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h3 class="mb-3 fw-bold text-center">Create an account</h3>

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
          </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" class="form-control" value="{{ old('name') }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-control" required>
          </div>

          <button class="btn btn-accent w-100">Register</button>
        </form>

        <p class="text-center mt-3 small">Already have an account? <a href="{{ route('login') }}" class="text-accent">Login</a></p>
      </div>
    </div>
  </div>
</div>
@endsection
