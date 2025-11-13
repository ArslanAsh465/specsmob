<!-- Latest Devices Section -->
<div class="overflow-hidden">
    <!-- Header -->
    <div class="text-center fw-bold text-white fs-4 py-2" style="background-color: #045CB4;">
        Latest Devices
    </div>

    <!-- Scrollable Body -->
    <div class="bg-light p-2" style="max-height: 300px; overflow-y: auto;">
        <div class="row g-2">
            @forelse($mobiles as $mobile)
                @php
                    $imagePath = public_path('uploads/mobiles/'.$mobile->image);
                    $imageUrl = file_exists($imagePath) && !empty($mobile->image) ? asset('uploads/mobiles/'.$mobile->image) : asset('app-assets/images/no-image.png');
                @endphp

                <div class="col-4">
                    <a href="{{ url($mobile->slug) }}" class="text-decoration-none d-block">
                        <!-- Card with fixed width & height -->
                        <div class="text-center rounded p-1" style="width: 100%; height: 150px; display: flex; flex-direction: column; justify-content: center; align-items: center;" onmouseover="this.querySelector('span').style.color='#f9a13d';" onmouseout="this.querySelector('span').style.color='#000';">
                            <img src="{{ $imageUrl }}" alt="{{ $mobile->name }}" class="img-fluid mb-1" style="width: 60px; height: 90px; object-fit: contain;">
                            <span class="fw-medium d-block small" style="color: #000;">
                                {{ $mobile->name }}
                            </span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-2">No devices available</div>
            @endforelse
        </div>
    </div>
</div>
