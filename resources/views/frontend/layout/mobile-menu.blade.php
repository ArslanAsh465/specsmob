<!-- Show only on mobile -->
<div class="d-flex justify-content-between align-items-center p-2 border-bottom bg-white d-md-none">
    <!-- Left: Logo -->
    <a href="{{ route('home') }}">
        <img src="{{ asset('app-assets/images/logo.png') }}" alt="Logo" height="40">
    </a>

    <!-- Right: Hamburger Button -->
    <button class="btn btn-outline-primary border-0 fs-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
        <i class="bi bi-list"></i>
    </button>
</div>

<!-- Offcanvas Menu -->
<div class="offcanvas offcanvas-end d-md-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileMenuLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">News</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Reviews</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Videos</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
    </div>
</div>
