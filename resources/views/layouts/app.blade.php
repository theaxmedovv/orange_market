<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>@yield('title', config('app.name', 'apelsin.'))</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
  :root {
    --bg: #0f1720;
    --card: #111827;
    --muted: #9ca3af;
    --accent: #f59e0b;
    --accent-2: #fbbf24;
  }
  html,body { background: var(--bg); color: #f8fafc; height:100%; }
  .card { background: var(--card); border: 1px solid rgba(255,255,255,0.04); }
  .navbar, footer { background: #07090b; }
  .text-accent { color: var(--accent); }
  .btn-accent { background: linear-gradient(90deg,var(--accent),var(--accent-2)); border: none; color: #111827; }
  .form-control, .form-select { background: #0b1220; color: #e6eef8; border:1px solid rgba(255,255,255,0.06); }
  a { color: inherit; text-decoration: none; }
  .product-img { max-height:220px; object-fit:contain; background: rgba(255,255,255,0.02); }
  .sidebar { background: #071019; border-right:1px solid rgba(255,255,255,0.03); min-height:100vh; }
  .nav-link.active { color: var(--accent-2) !important; }
</style>

@stack('head')
</head>
<body>
  {{-- NAVBAR --}}
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
        <img src="{{ asset('images/orange.jpg') }}" alt="logo" style="width:34px;border-radius:50%;">
        <span class="fw-bold text-accent">apelsin<span class="text-warning">.</span></span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <form class="d-flex mx-auto" action="{{ route('home') }}" method="GET" style="max-width:700px;">
          <div class="input-group">
            <input name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
          </div>
        </form>

        <ul class="navbar-nav ms-auto align-items-center">
          @auth
            @if(auth()->user()->is_admin)
              <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a></li>
            @endif
            <li class="nav-item"><a class="nav-link" href="{{ route('wishlist.index') }}"><i class="bi bi-heart"></i></a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}"><i class="bi bi-cart3"></i></a></li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle fs-5 me-2"></i>
                <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                <li class="dropdown-item-text">
                  <strong>{{ Auth::user()->name }}</strong><br>
                  <small class="text-muted">{{ Auth::user()->email }}</small>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="btn btn-accent ms-2" href="{{ route('register') }}">Register</a></li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  {{-- FLASH --}}
  <div class="container mt-4">
    @if(session('success'))
      <div class="alert alert-success text-dark">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
  </div>

  {{-- MAIN --}}
  <main class="py-4">
    @yield('content')
  </main>

  {{-- FOOTER --}}
  <footer class="py-4 mt-5">
    <div class="container text-center text-muted">
      © {{ date('Y') }} apelsin. — Built with ❤️
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
