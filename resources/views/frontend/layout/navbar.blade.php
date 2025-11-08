<style>
    @media (max-width: 767.98px) {
        .d-none-desktop {
            display: none;
        }
    }

    /* Left-side navbar links */
    .navbar-nav .nav-link {
        font-size: 1.2rem;
        font-weight: 700;
        color: #FFFFFF; /* Default white color */
        transition: color 0.3s ease;
        margin-right: 1.3rem; /* Spacing between menu items */
    }

    /* Hover effect for left-side links */
    .navbar-nav .nav-link:hover {
        color: #F9A13D !important;
    }

    /* Active menu link */
    .navbar-nav .nav-link.active {
        color: #F9A13D !important;
    }

    /* Right-side icons pop-up effect */
    .navbar-icons a {
        transition: transform 0.2s ease, color 0.2s ease;
        color: #FFFFFF;
    }

    .navbar-icons a:hover {
        transform: scale(1.3);
        color: #F9A13D !important;
    }
</style>

<nav id="navbarMenu" class="navbar navbar-expand-lg navbar-dark mt-2 d-none-desktop" style="background-color: #045CB4">
    <div class="container">
        <!-- Left: Navigation Links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">NEWS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}" href="{{ route('reviews') }}">REVIEWS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('videos') ? 'active' : '' }}" href="{{ route('videos') }}">VIDEOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">CONTACT US</a>
            </li>
        </ul>

        <!-- Right: Login / Sign Up or Dashboard / Logout -->
        <div class="d-flex align-items-center gap-3 navbar-icons">
            @guest
                <a href="{{ route('login') }}" class="fs-4 fw-bold text-decoration-none" title="Login to your account">
                    <i class="bi bi-box-arrow-in-right"></i>
                </a>
                <a href="{{ route('register') }}" class="fs-4 fw-bold text-decoration-none" title="Create a new account">
                    <i class="bi bi-person-plus"></i>
                </a>
            @else
                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                    <a href="{{ route('backend.dashboard') }}" class="fs-4 fw-bold text-decoration-none" title="Dashboard">
                        <i class="bi bi-speedometer2"></i>
                    </a>
                @endif

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="fs-4 fw-bold text-decoration-none" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</nav>
