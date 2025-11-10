@extends('frontend.layout.app')

@section('content')
    <!-- Page Header Section -->
    <div class="text-white text-center" style="background: url('{{ asset('app-assets/images/reviews.jpg') }}') center center / cover no-repeat; height: 200px;">
        <div class="d-flex justify-content-center align-items-center bg-dark bg-opacity-50 w-100 h-100">
            <h1 class="fw-bold my-0">Reviews</h1>
        </div>
    </div>

    <!-- Reviews Listing Section -->
    <div class="container my-5">
        @if($reviews->count() > 0)
            @php
                $defaultImage = asset('app-assets/images/no-image.png');
            @endphp

            @foreach($reviews as $item)
                @php
                    $image = $item->image ? asset('storage/' . $item->image) : $defaultImage;
                @endphp

                <!-- Review Card -->
                <div class="card mb-4 shadow-sm overflow-hidden rounded-3">
                    <a href="{{ route('review.show', $item->slug) }}" class="text-decoration-none text-dark">
                        <div class="row g-0">
                            <!-- Image (Left) -->
                            <div class="col-md-6">
                                <img src="{{ $image }}" class="img-fluid w-100 h-100" alt="{{ $item->title }}" style="object-fit: cover; height: 100%;">
                            </div>

                            <!-- Info (Right) -->
                            <div class="col-md-6 d-flex flex-column justify-content-center p-4 bg-light">
                                <!-- Meta Info -->
                                <div class="text-muted mb-2 small">
                                    <i class="bi bi-calendar3 me-1"></i> {{ $item->created_at->format('M d, Y') }}
                                    @if(property_exists($item, 'comments_count') && $item->comments_count)
                                        | <i class="bi bi-chat-left-text me-1"></i> {{ $item->comments_count }} Comments
                                    @endif
                                    @if(property_exists($item, 'stars') && $item->stars)
                                        | <i class="bi bi-star-fill text-warning me-1"></i> {{ $item->stars }}/5
                                    @endif
                                </div>

                                <!-- Title -->
                                <h4 class="fw-semibold mb-3">{{ $item->title }}</h4>

                                <!-- Excerpt -->
                                @if(!empty($item->description))
                                    <p class="text-secondary mb-0">{{ Str::limit($item->description, 180) }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $reviews->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-muted text-center">No reviews found.</p>
        @endif
    </div>
@endsection
