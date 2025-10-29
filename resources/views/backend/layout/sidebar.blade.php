<style>
    /* Hide sidebar on mobile/small screens */
    @media (max-width: 767.98px) {
        #sidebar {
            display: none !important;
        }
        body {
            padding-left: 0 !important;
        }
    }

    /* Desktop and larger screens */
    @media (min-width: 768px) {
        #sidebar {
            display: flex !important;
            width: 250px !important;
            max-width: 250px !important;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            background-color: #fff;
            z-index: 1020;
            transition: width 0.3s ease;
        }

        /* Push body content to the right */
        body {
            padding-left: 250px !important;
        }
    }

    /* Sidebar link styling */
    #sidebar .nav-link {
        color: #212529;
        font-weight: 400;
        transition: all 0.2s ease;
    }

    /* Active link */
    #sidebar .nav-link.active {
        background-color: #0d6efd;
        color: #fff !important;
        font-weight: 500;
        border-radius: 0.375rem;
    }

    #sidebar .nav-link.active i {
        color: #fff !important;
    }

    /* Hover state for inactive links */
    #sidebar .nav-link:not(.active):hover {
        background-color: #e9ecef;
        color: #000 !important;
        border-radius: 0.375rem;
    }

    #sidebar .nav-link:not(.active):hover i {
        color: #000 !important;
    }
</style>

<nav id="sidebar" class="border-end d-flex flex-column bg-white">
    <!-- Brand -->
    <div class="d-flex justify-content-center align-items-center py-3 border-bottom" style="height: 60px;">
        <a href="{{ route('home') }}" target="_blank" class="text-decoration-none">
            <img src="{{ asset('app-assets/images/logo.png') }}" alt="Admin Panel" style="height: 40px;">
        </a>
    </div>

    <!-- Menu Options -->
    <ul class="nav flex-column p-3 gap-2">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('backend.dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span class="ms-2">Dashboard</span>
            </a>
        </li>

        <!-- Admins -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="{{ route('backend.admins.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.admins.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Admins</span>
                </a>
            </li>
        @endif

        <!-- Managers -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="{{ route('backend.managers.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.managers.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Managers</span>
                </a>
            </li>
        @endif

        <!-- Users -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="{{ route('backend.users.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.users.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Users</span>
                </a>
            </li>
        @endif

        <!-- Brands -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="{{ route('backend.brands.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.brands.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Brands</span>
                </a>
            </li>
        @endif

        <!-- Mobiles -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="{{ route('backend.mobiles.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.mobiles.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Mobiles</span>
                </a>
            </li>
        @endif

        <!-- Mobile Comments -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.mobiles.comments*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Mobile Comments</span>
                </a>
            </li>
        @endif

        <!-- News -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.news.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Mobiles</span>
                </a>
            </li>
        @endif

        <!-- News Comments -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.news.comments*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">News Comments</span>
                </a>
            </li>
        @endif

        <!-- Reviews -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.reviews.*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Reviews</span>
                </a>
            </li>
        @endif

        <!-- Review Comments -->
        @if(auth()->user()->role === '1')
            <li class="nav-item">
                <a href="#" class="nav-link d-flex align-items-center {{ request()->routeIs('backend.reviews.comments*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Review Comments</span>
                </a>
            </li>
        @endif
    </ul>
</nav>
