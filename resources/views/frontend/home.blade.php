@extends('frontend.layout.app')

@section('content')
@php
    $noImage = asset('app-assets/images/no-image.png');
@endphp

<div class="m-0 p-0">

    {{-- Hero Section --}}
    @if(isset($featuredDevice))
        @php
            $heroImage = $featuredDevice->image ? asset('storage/' . $featuredDevice->image) : $noImage;
        @endphp
        <div class="card bg-dark text-white mb-5">
            <img src="{{ $heroImage }}" class="card-img" style="object-fit: cover; height: 450px;" alt="{{ $featuredDevice->name }}">
            <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: rgba(0,0,0,0.4);">
                <h1 class="card-title display-4 fw-bold">{{ $featuredDevice->name }}</h1>
                <p class="card-text">{{ Str::limit($featuredDevice->description, 150) }}</p>
                <a href="{{ route('mobile.show', $featuredDevice->slug) }}" class="btn btn-primary btn-lg mt-2">Read More</a>
            </div>
        </div>
    @endif

    {{-- Latest Devices Section --}}
    <h2 class="fw-bold mb-4">Latest Devices</h2>
    <div class="row g-4 mb-5">
        @foreach($latestDevices as $device)
            @php
                $deviceImage = $device->image ? asset('storage/' . $device->image) : $noImage;
            @endphp
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $deviceImage }}" class="card-img-top" style="object-fit: cover; height: 200px;" alt="{{ $device->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $device->name }}</h5>
                        <p class="card-text text-muted mb-2">{{ Str::limit($device->description, 100) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $device->created_at->format('M d, Y') }}</small>
                            <span class="badge bg-primary">{{ $device->comments_count ?? 0 }} Comments</span>
                        </div>
                        <a href="{{ route('mobile.show', $device->slug) }}" class="btn btn-outline-primary btn-sm mt-3">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Latest Reviews Section --}}
    <h2 class="fw-bold mb-4">Latest Reviews</h2>
    <div class="row g-4 mb-5">
        @foreach($latestReviews as $review)
            @php
                $reviewImage = $review->image ? asset('storage/' . $review->image) : $noImage;
            @endphp
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $reviewImage }}" class="card-img-top" style="object-fit: cover; height: 200px;" alt="{{ $review->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $review->title }}</h5>
                        <p class="card-text text-muted mb-2">{{ Str::limit($review->excerpt, 100) }}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                            <span class="badge bg-success">{{ $review->comments_count ?? 0 }} Comments</span>
                        </div>
                        <a href="{{ route('review.show', $review->slug) }}" class="btn btn-outline-success btn-sm mt-3">Read Review</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Categories / Brands Section --}}
    <h2 class="fw-bold mb-4">Popular Brands</h2>
    <div class="row g-3 mb-5">
        @foreach($brands as $brand)
            @php
                $brandImage = $brand->logo ? asset('storage/' . $brand->logo) : $noImage;
            @endphp
            <div class="col-6 col-md-3">
                <a href="{{ route('brand.show', $brand->slug) }}" class="text-decoration-none">
                    <div class="card text-center border-0 shadow-sm h-100 p-3">
                        <img src="{{ $brandImage }}" class="card-img-top mx-auto" style="width: 80px; height: 80px; object-fit: contain;" alt="{{ $brand->name }}">
                        <div class="card-body p-2">
                            <h6 class="card-title text-dark">{{ $brand->name }}</h6>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Newsletter / CTA --}}
    <div class="card bg-primary text-white text-center p-5 mb-5">
        <h3 class="fw-bold mb-3">Stay Updated With the Latest Mobile News</h3>
        <p class="mb-4">Subscribe to our newsletter to get the latest device reviews, rumors, and news directly in your inbox.</p>
        <form class="row g-2 justify-content-center">
            <div class="col-auto">
                <input type="email" class="form-control form-control-lg" placeholder="Enter your email">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-dark btn-lg">Subscribe</button>
            </div>
        </form>
    </div>

</div>
@endsection
