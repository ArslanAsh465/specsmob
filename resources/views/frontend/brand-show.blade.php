@extends('frontend.layout.app')

@section('content')
<div class="m-0 p-0">
    <h1 class="mb-4">{{ $brand->name }}</h1>

    @if($brand->mobiles->count() > 0)
        <div class="row g-3">
            @foreach($brand->mobiles as $mobile)
                @php
                    $defaultImage = asset('app-assets/images/no-image.png');
                    $mobileImage = $mobile->image ? asset('storage/' . $mobile->image) : $defaultImage;
                @endphp

                <div class="col-md-4">
                    <div class="card shadow-sm rounded-3 h-100 position-relative overflow-hidden">
                        <!-- Stretched link to make whole card clickable -->
                        <a href="{{ route('mobile.show', $mobile->slug) }}" class="stretched-link"></a>

                        <!-- Mobile Image -->
                        <img src="{{ $mobileImage }}" class="card-img-top" alt="{{ $mobile->name }}" style="height: 200px; object-fit: cover;">

                        <div class="card-body">
                            <h5 class="fw-bold mb-2">{{ $mobile->name }}</h5>
                            <p class="mb-0 text-muted">
                                Released: {{ $mobile->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-muted">No mobiles found for this brand.</p>
    @endif
</div>
@endsection
