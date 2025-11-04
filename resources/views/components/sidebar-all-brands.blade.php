<div class="sidebar-section">
    <h6 class="text-uppercase fw-bold mb-3">Brands</h6>
    <ul class="nav flex-column">
        @forelse($brands as $brand)
            <li class="nav-item">
                <a href="{{ url($brand->slug) }}" class="nav-link py-1">
                    {{ $brand->name }}
                </a>
            </li>
        @empty
            <li class="text-muted">No brands available</li>
        @endforelse
    </ul>
</div>
