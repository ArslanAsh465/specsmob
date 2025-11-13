<div class="overflow-hidden p-3">
    <!-- Header -->
    <div class="text-center fw-bold text-white fs-4 py-2" style="background-color: #045CB4;">
        POPULAR DEVICES
    </div>

    <!-- Scrollable list -->
    <div class="bg-light p-2">
        @forelse($mobiles as $index => $mobile)
            <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                <!-- Number -->
                <div class="fw-bold text-center" style="width: 30px;">{{ $index + 1 }}.</div>

                <!-- Device Name -->
                <div class="flex-grow-1 px-2">
                    <a href="{{ url($mobile->slug) }}" class="text-decoration-none text-dark fw-medium">
                        <span onmouseover="this.style.color='#f9a13d';" onmouseout="this.style.color='#000';">
                            {{ $mobile->name }}
                        </span>
                    </a>
                </div>

                <!-- Views -->
                <div class="text-center" style="width: 60px;">{{ number_format($mobile->views) }}</div>
            </div>
        @empty
            <div class="text-center text-muted py-2">No devices available</div>
        @endforelse
    </div>
</div>
