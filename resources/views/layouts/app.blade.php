<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'apelsin.') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { background-color: #1a1a1a; color: #f8f9fa; }
        .form-select, .form-control {
            background-color: #343a40 !important;
            color: #f8f9fa !important;
            border-color: #495057 !important;
        }
        .form-select:focus, .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25) !important;
        }
        footer {
            background: #000;
            color: #aaa;
            text-align: center;
            padding: 15px 0;
            margin-top: 50px;
            border-top: 1px solid #333;
        }
        .pagination .page-item .page-link {
            background-color: #343a40;
            border-color: #495057;
            color: #fff;
        }
        .pagination .page-item.active .page-link {
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
            color: #212529 !important;
        }
    </style>
</head>
<body class="bg-dark">

    {{-- Navbar will be included in pages that extend this layout --}}
    <main>
        @yield('content')
    </main>

    <footer>
        <p class="mb-0">© {{ date('Y') }} apelsin.. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
        });
    </script>
</body>
</html>
