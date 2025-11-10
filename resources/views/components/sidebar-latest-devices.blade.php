<!-- Latest Devices Section -->
<div class="border rounded overflow-hidden">
    <!-- Header -->
    <div class="text-center fw-bold text-white fs-4 py-2" style="background-color: #f9a13d;">
        Latest Devices
    </div>

    <!-- Body -->
    <div class="bg-light p-2">
        @forelse($mobiles as $mobile)
            @php
                $imagePath = public_path('uploads/mobiles/'.$mobile->image);
                $imageUrl = file_exists($imagePath) && !empty($mobile->image)
                    ? asset('uploads/mobiles/'.$mobile->image)
                    : asset('app-assets/images/no-image.png');
            @endphp

            <div class="d-flex align-items-center gap-2 py-2 px-2 rounded mb-1 bg-white">
                <!-- Image -->
                <img src="{{ $imageUrl }}" alt="{{ $mobile->name }}" 
                     class="img-fluid rounded" 
                     style="width: 40px; height: 40px; object-fit: cover;">

                <!-- Clickable Name Only -->
                <a href="{{ url($mobile->slug) }}" 
                   class="text-decoration-none text-dark fw-medium">
                    {{ $mobile->name }}
                </a>
            </div>
        @empty
            <div class="text-center text-muted py-2">No devices available</div>
        @endforelse
    </div>
</div>

<style>
    .bg-white:hover {
        background-color: #f8f9fa;
    }

    .fw-medium a:hover {
        color: #0d6efd;
        text-decoration: none;
    }
</style>
