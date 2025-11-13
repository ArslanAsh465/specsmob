@extends('frontend.layout.app')

@section('content')
    @php
        $noImage = asset('app-assets/images/no-image.png');
    @endphp

    <div class="m-0 p-0">
        @if ($mobiles->count() > 0)
            <div class="row g-3">
                @foreach ($mobiles as $mobile)
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="{{ route('mobile.show', $mobile->slug) }}" class="text-decoration-none text-dark">
                            <div class="bg-white rounded shadow-sm h-100">
                                <!-- Mobile Image -->
                                <img src="{{ $mobile->image ? asset('storage/' . $mobile->image) : $noImage }}" alt="{{ $mobile->name }}" class="card-img-top" style="height: 150px; object-fit: contain; background: #f8f9fa;">

                                <!-- Card Content -->
                                <div class="card-body text-center py-2">
                                    <h6 class="fw-bold mb-1" style="transition: color 0.3s ease;" onmouseover="this.style.color='#f9a13d';" onmouseout="this.style.color='';">
                                        {{ $mobile->name }}
                                    </h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-4">
                No devices found for this brand.
            </div>
        @endif
    </div>
@endsection
