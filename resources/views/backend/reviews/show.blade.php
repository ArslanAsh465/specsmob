@extends('backend.layout.app')

@if(!empty($title))
    @section('title', $title)
@endif

@section('content')
    <!-- Page Header -->
    <div class="mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.reviews.index') }}" class="text-decoration-none">Reviews</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Review</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">{{ $review->title ?? $review->name }}</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.reviews.edit', $review->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Review
                </a>
            </div>
        </div>
    </div>

    <!-- Review Details -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <div class="row g-3">

            <!-- General Info -->
            <div class="col-md-6"><strong>Reviewer:</strong> {{ $review->user->name ?? '-' }}</div>
            <div class="col-md-6"><strong>Rating:</strong>
                @for($i = 0; $i < 5; $i++)
                    @if($i < $review->stars)
                        <i class="bi bi-star-fill text-warning"></i>
                    @else
                        <i class="bi bi-star text-secondary"></i>
                    @endif
                @endfor
            </div>
            <div class="col-md-6"><strong>Slug:</strong> {{ $review->slug ?? '-' }}</div>
            <div class="col-md-6"><strong>Status:</strong>
                @if($review->status === 'published')
                    <span class="badge bg-success">Published</span>
                @elseif($review->status === 'draft')
                    <span class="badge bg-warning">Draft</span>
                @else
                    <span class="badge bg-secondary">Archived</span>
                @endif
            </div>

            <!-- Image -->
            <div class="col-12"><h5 class="mt-3">Image</h5></div>
            <div class="col-12">
                @if($review->image)
                    <img src="{{ asset('storage/' . $review->image) }}" alt="{{ $review->title ?? $review->name }}" class="img-fluid rounded">
                @else
                    <p>No image uploaded.</p>
                @endif
            </div>

            <!-- Body / Review Content -->
            <div class="col-12"><h5 class="mt-3">Content</h5></div>
            <div class="col-12">{!! $review->body ?? $review->content !!}</div>

            <!-- SEO -->
            <div class="col-12"><h5 class="mt-3">SEO</h5></div>
            <div class="col-md-6"><strong>SEO Title:</strong> {{ $review->seo_title ?? '-' }}</div>
            <div class="col-md-6"><strong>SEO Keywords:</strong> {{ $review->seo_keywords ?? '-' }}</div>
            <div class="col-12"><strong>SEO Description:</strong> {{ $review->seo_description ?? '-' }}</div>
        </div>
    </div>
@endsection
