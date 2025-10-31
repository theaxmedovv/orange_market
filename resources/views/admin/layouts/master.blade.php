@extends('layouts.app')

@push('head')
<style>
  .admin-main { display:flex; gap:0; align-items:stretch; }
  .admin-sidebar { width:240px; padding:20px; }
  .admin-content { flex:1; padding:30px; }
  .sidebar .nav-link { color:#cbd5e1; padding:10px 12px; display:block; border-radius:8px; }
  .sidebar .nav-link:hover { background: rgba(255,255,255,0.02); color:var(--accent-2); }
</style>
@endpush

@section('content')
<div class="admin-main">
  <aside class="sidebar admin-sidebar">
    <h4 class="fw-bold text-accent">Admin</h4>
    <nav class="mt-4">
      <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
      <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}"><i class="bi bi-box-seam me-2"></i> Products</a>
      <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i> Users</a>
      <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-arrow-left me-2"></i> Back to shop</a>
    </nav>
  </aside>

  <div class="admin-content">
    @yield('admin-content')
  </div>
</div>
@endsection
