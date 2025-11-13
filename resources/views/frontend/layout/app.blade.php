<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>@yield('title', $seo['title'] ?? 'SpecsMob')</title>

    <!-- Meta Tags -->
    <meta name="description" content="@yield('meta_description', $seo['description'] ?? 'SpecsMob - Latest tech news, reviews, and mobile specs.')">
    <meta name="keywords" content="@yield('meta_keywords', $seo['keywords'] ?? 'mobile, news, reviews, specs')">
    <meta name="author" content="@yield('meta_author', 'SpecsMob')">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="@yield('og_title', $seo['title'] ?? 'SpecsMob')">
    <meta property="og:description" content="@yield('og_description', $seo['description'] ?? 'SpecsMob - Latest tech news, reviews, and mobile specs.')">
    <meta property="og:image" content="@yield('og_image', $seo['image'] ?? asset('app-assets/images/favicon.png'))">
    <meta property="og:url" content="@yield('og_url', $seo['url'] ?? url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', $seo['title'] ?? 'SpecsMob')">
    <meta name="twitter:description" content="@yield('twitter_description', $seo['description'] ?? 'SpecsMob - Latest tech news, reviews, and mobile specs.')">
    <meta name="twitter:image" content="@yield('twitter_image', $seo['image'] ?? asset('app-assets/images/favicon.png'))">

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
    <!-- Mobile Navbar -->
    @include('frontend.layout.mobile-menu')

    <!-- Topbar -->
    @include('frontend.layout.topbar')

    <!-- Navbar -->
    @include('frontend.layout.navbar')

    <div class="container">
        <div class="d-flex">
            <aside class="d-none d-lg-block col-lg-3">
                @include('frontend.layout.sidebar')
            </aside>

            <main class="flex-grow-1 p-4 col-12 col-lg-9">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Navbar -->
    @include('frontend.layout.mobile-bottom-bar')

    <!-- Footer -->
    @include('frontend.layout.footer')

    <!-- JS -->
    <script src="{{ asset('app-assets/js/bootstrap.min.js') }}"></script>

    <!-- Custom footer scripts or content -->
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
