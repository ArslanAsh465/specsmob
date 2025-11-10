<style>
    @media (max-width: 767.98px) {
        .d-none-desktop {
            display: none;
        }
    }
</style>

<div class="topbar py-0 my-0 d-none-desktop">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left: Logo (7 columns) -->
            <div class="col-7 d-flex align-items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('app-assets/images/logo.png') }}" alt="Logo" width="140" class="me-2">
                </a>
            </div>

            <!-- Right: Search + Hamburger (5 columns) -->
            <div class="col-5 d-flex align-items-center justify-content-end gap-3">
                <!-- Search Bar with Button (hidden on small screens) -->
                <form class="d-none d-md-flex w-100" role="search" autocomplete="off">
                    <div class="input-group position-relative">
                        <input type="search" id="mobile-search" name="query" class="form-control py-2" placeholder="Search Mobile Phones..." aria-label="Search">
                        <button class="btn search-btn py-2 px-3" type="submit" style="background-color: #f9a13d; color: #fff;">
                            <i class="bi bi-search"></i>
                        </button>
                        <!-- Live search results dropdown -->
                        <div id="search-results" class="list-group position-absolute w-100" style="z-index: 1000; top: 100%; display: none;"></div>
                    </div>
                </form>

                <!-- Hamburger Menu -->
                <button id="navbar-toggle" class="btn border-0 py-2 px-3" style="background-color: #045cb4; color: #fff;">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('mobile-search');
        const resultsContainer = document.getElementById('search-results');

        searchInput.addEventListener('keyup', function() {
            const query = this.value;

            if (query.length > 0) {
                fetch(`/ajax-search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        let html = '';
                        if (data.length > 0) {
                            data.forEach(mobile => {
                                html += `<a href="/mobile/${mobile.id}" class="list-group-item list-group-item-action">${mobile.name}</a>`;
                            });
                        } else {
                            html = '<span class="list-group-item">No results found</span>';
                        }
                        resultsContainer.innerHTML = html;
                        resultsContainer.style.display = 'block';
                    });
            } else {
                resultsContainer.style.display = 'none';
            }
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
                resultsContainer.style.display = 'none';
            }
        });
    });
</script>
