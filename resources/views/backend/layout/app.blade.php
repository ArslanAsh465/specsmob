<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    <!-- Bootstrap Icons -->
    <link href="{{ asset('app-assets/css/bootstrap-icons.min.css') }}" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="{{ asset('app-assets/js/sweetalert2.min.js') }}"></script>

    <!-- Custom header section for child views -->
    @yield('header')
</head>
<body>
    <!-- SweetAlert notification -->
    @include('backend.layout.alert')

    <!-- Mobile Navbar -->
    @include('backend.layout.mobile-navbar')

    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        @include('backend.layout.sidebar')

        <div class="flex-grow-1 d-flex flex-column">
            <!-- Navbar -->
            @include('backend.layout.navbar')

            <main id="main-content" class="flex-grow-1 p-3">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom footer scripts or content -->
    @yield('footer')
</body>
</html>
