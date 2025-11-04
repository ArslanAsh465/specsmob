<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>
        @hasSection('title')
            @yield('title') - SpecsMob
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

    <div class="container">
        <div class="d-flex">
            <!-- Sidebar: 25% width on large screens only -->
            <aside class="bg-light p-3 d-none d-lg-block col-lg-3">
                @include('frontend.layout.sidebar')
            </aside>

            <!-- Main Content: remaining width -->
            <main class="flex-grow-1 p-4 col-12 col-lg-9">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    @include('frontend.layout.footer')

    <!-- JS -->
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>

    {{-- Custom footer scripts or content --}}
    @yield('footer')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById('navbar-toggle');
            const navbar = document.getElementById('navbarMenu');
            const storageKey = 'navbarVisible';

            if (!toggleBtn || !navbar) return;

            const savedState = localStorage.getItem(storageKey);

            if (savedState === 'visible') {
                navbar.classList.remove('d-none');
            } else {
                navbar.classList.add('d-none');
            }

            toggleBtn.addEventListener('click', function () {
                navbar.classList.toggle('d-none');

                const isVisible = !navbar.classList.contains('d-none');
                localStorage.setItem(storageKey, isVisible ? 'visible' : 'hidden');
            });
        });
    </script>
</body>

</html>
