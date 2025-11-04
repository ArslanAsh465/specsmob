<div class="topbar py-0 my-0">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Left: Logo -->
        <div class="d-flex align-items-center">
            <img src="{{ asset('app-assets/images/logo.png') }}" alt="Logo" width="140" class="me-2">
        </div>

        <!-- Right: Search + Hamburger -->
        <div class="d-flex align-items-center gap-3">
            <!-- Search Bar -->
            <form class="d-none d-md-flex" role="search">
                <input class="form-control form-control-sm" type="search" placeholder="Search..." aria-label="Search">
                <button class="btn btn-sm btn-primary ms-2" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <!-- Hamburger Menu -->
            <button id="navbar-toggle" class="btn btn-sm btn-primary border-0">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </div>
</div>
