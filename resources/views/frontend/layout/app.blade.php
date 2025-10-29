<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>
        @hasSection('title')
            @yield('title') - STED
        @else
            STED
        @endif
    </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('app-assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Icons CSS -->
    <link href="{{ asset('app-assets/css/bootstrap-icons.min.css') }}" rel="stylesheet">

    {{-- Custom header section for child views --}}
    @yield('header')
</head>

<body>
    <!-- Topbar -->
    @include('frontend.layout.topbar')

    <!-- Navbar -->
    @include('frontend.layout.navbar')

    <div class="d-flex">
        <!-- Sidebar -->
        <aside class="sidebar bg-light p-3" style="width: 250px; min-height: 100vh;">
            @include('frontend.layout.sidebar')
        </aside>

        <!-- Main Content -->
        <main class="flex-grow-1 p-4">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Footer -->
    @include('frontend.layout.footer')

    <!-- JS -->
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>

    {{-- Custom footer scripts or content --}}
    @yield('footer')

    <script>
        // Toggle navbar visibility when hamburger icon clicked
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById('navbar-toggle');
            const navbar = document.getElementById('navbarMenu');

            if (toggleBtn && navbar) {
                toggleBtn.addEventListener('click', function() {
                    navbar.classList.toggle('d-none');
                });
            }
        });
    </script>
</body>

</html>
