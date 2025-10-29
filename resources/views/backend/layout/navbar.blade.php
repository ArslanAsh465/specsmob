@section('header')
    <style>
        /* Hide navbar on mobile screens */
        @media (max-width: 767.98px) {
            #main-navbar {
                display: none !important;
            }
        }

        /* Show navbar on tablet and desktop */
        @media (min-width: 768px) {
            #main-navbar {
                display: flex !important;
            }
        }
    </style>
@endsection

<nav id="main-navbar" class="navbar navbar-expand-lg sticky-top w-100 border-bottom p-0 bg-white">
    <div class="container-fluid">
        <div></div>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ auth()->user()->name ?? 'User' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 200px;">
                    <li><a class="dropdown-item border-bottom mb-1" href="#">Option 1</a></li>
                    <li><a class="dropdown-item border-bottom mb-1" href="#">Option 2</a></li>
                    <li><a class="dropdown-item border-bottom mb-1" href="#">Option 3</a></li>
                    <li><a class="dropdown-item mb-1" href="#">Option 4</a></li>
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
            </li>
        </ul>
    </div>
</nav>

@section('footer')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Navbar loaded successfully');
        });
    </script>
@endsection