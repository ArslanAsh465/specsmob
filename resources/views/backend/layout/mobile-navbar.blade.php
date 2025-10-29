@section('header')
    <style>
        /* Ensure mobile navbar only appears on small devices */
        @media (min-width: 768px) {
            #mobile-navbar, 
            #mobileSidebar {
                display: none !important;
            }
        }

        /* Active state for links inside offcanvas */
        .offcanvas .nav-link.active {
            background-color: #f8f9fa;
            border-radius: 4px;
            font-weight: 500;
        }

        /* Offcanvas transition customization (optional) */
        .offcanvas {
            transition: transform 0.3s ease-in-out;
        }
    </style>
@endsection

<nav id="mobile-navbar" class="navbar navbar-light bg-white border-bottom d-flex d-md-none px-3 justify-content-between align-items-center" style="height: 60px;">
    <!-- Sidebar Toggle Button -->
    <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Logo -->
    <a href="{{ route('home') }}" class="navbar-brand m-0">
        <img src="{{ asset('app-assets/images/logo.png') }}" alt="Logo" style="height: 30px;">
    </a>

    <!-- User Dropdown -->
    <div class="dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle me-1 fs-5"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item border-bottom mb-1" href="#">Option 1</a></li>
            <li><a class="dropdown-item border-bottom mb-1" href="#">Option 2</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="nav flex-column gap-2">
            <li class="nav-item">
                <a href="{{ route('backend.dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" data-bs-dismiss="offcanvas">
                    <i class="bi bi-speedometer2"></i>
                    <span class="ms-2">Dashboard</span>
                </a>
            </li>
            {{-- Add more menu links here --}}
        </ul>
    </div>
</div>

@section('footer')
    <script>
        // You can place additional JS related to mobile navbar/offcanvas here
        document.addEventListener('DOMContentLoaded', () => {
            const offcanvasEl = document.getElementById('mobileSidebar');
            offcanvasEl.addEventListener('shown.bs.offcanvas', () => {
                console.log('Mobile sidebar opened');
            });
        });
    </script>
@endsection
