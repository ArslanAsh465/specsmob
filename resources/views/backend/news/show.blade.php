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
                <li class="breadcrumb-item"><a href="{{ route('backend.news.index') }}" class="text-decoration-none">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">View News</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">{{ $news->title }}</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.news.edit', $news->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit News
                </a>
            </div>
        </div>
    </div>

    <!-- News Details -->
    <div class="shadow-sm rounded bg-white p-3 mt-4">
        <div class="row g-3">

            <!-- General Info -->
            <div class="col-md-6"><strong>Author:</strong> {{ $news->user->name ?? '-' }}</div>
            <div class="col-md-6"><strong>Mobile:</strong> {{ $news->mobile->name ?? '-' }}</div>
            <div class="col-md-6"><strong>Slug:</strong> {{ $news->slug }}</div>
            <div class="col-md-6"><strong>Status:</strong>
                @if($news->status === 'published')
                    <span class="badge bg-success">Published</span>
                @elseif($news->status === 'draft')
                    <span class="badge bg-warning">Draft</span>
                @else
                    <span class="badge bg-secondary">Archived</span>
                @endif
            </div>
            <div class="col-md-6"><strong>Views:</strong> {{ $news->views }}</div>

            <!-- Image -->
            <div class="col-12"><h5 class="mt-3">Image</h5></div>
            <div class="col-12">
                @if($news->image)
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="img-fluid rounded">
                @else
                    <p>No image uploaded.</p>
                @endif
            </div>

            <!-- Body -->
            <div class="col-12"><h5 class="mt-3">Content</h5></div>
            <div class="col-12">{!! $news->body !!}</div>

            <!-- SEO -->
            <div class="col-12"><h5 class="mt-3">SEO</h5></div>
            <div class="col-md-6"><strong>SEO Title:</strong> {{ $news->seo_title ?? '-' }}</div>
            <div class="col-md-6"><strong>SEO Keywords:</strong> {{ $news->seo_keywords ?? '-' }}</div>
            <div class="col-12"><strong>SEO Description:</strong> {{ $news->seo_description ?? '-' }}</div>
        </div>
    </div>
@endsection
