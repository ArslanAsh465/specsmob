<!-- Brands Section -->
<div class="border-0">
    <!-- Header -->
    <a href="{{ route('brands') }}" class="d-block text-center fw-bold text-white text-decoration-none w-100 fs-4" style="background-color: #f9a13d;">
        Brands
    </a>

    <!-- Body -->
    <div class="bg-light p-2">
        <div class="row row-cols-4">
            @forelse($brands as $brand)
                <div class="col">
                    <a href="{{ url($brand->slug) }}" class="d-block text-center text-truncate py-1 bg-light text-decoration-none">
                        {{ $brand->name }}
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No brands available</div>
            @endforelse
        </div>
    </div>
</div>
