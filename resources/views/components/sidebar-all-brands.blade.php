<!-- PHONE FINDER -->
<div class="card mb-4 border-0">
    <!-- Header -->
    <a href="{{ route('phone.finder') }}" class="card-header rounded-0 fs-5 text-white text-center fw-bold text-decoration-none d-block" style="background-color: #045CB4;">
        PHONE FINDER
    </a>

    <!-- Body -->
    <div class="card-body p-0 m-0 border">
        <div class="row g-0">
            @forelse($brands as $brand)
                <div class="col-3 text-center {{ $loop->iteration % 4 != 0 ? 'border-end' : '' }}">
                    <a href="{{ route('brand.show', $brand->slug) }}" class="d-block text-decoration-none fw-bold py-1 small" style="font-size: 11px; transition: all 0.2s; color: #000; background-color: transparent;" onmouseover="this.style.color='#fff'; this.style.backgroundColor='#045CB4';" onmouseout="this.style.color='#000'; this.style.backgroundColor='transparent';">
                        {{ strtoupper($brand->name) }}
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-2" style="font-size: 12px;">
                    No brands available
                </div>
            @endforelse
        </div>
    </div>

    <!-- Footer -->
    <a href="{{ route('brands') }}" class="card-footer rounded-0 bg-secondary text-white text-center fw-bold text-decoration-none d-block">
        All Brands
    </a>
</div>
