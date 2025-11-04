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
                <li class="breadcrumb-item"><a href="{{ route('backend.brands.index') }}" class="text-decoration-none">Brands</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Brand</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">{{ $brand->name }}</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.brands.edit', $brand->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Brand
                </a>
            </div>
        </div>
    </div>

    <!-- Brand Details -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Slug:</strong> {{ $brand->slug }}
            </div>
            <div class="col-md-6">
                <strong>Status:</strong> 
                @if($brand->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>
            <div class="col-md-6">
                <strong>Added By:</strong> {{ $brand->user->name ?? 'N/A' }}
            </div>
        </div>
    </div>

    <!-- Associated Mobiles -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <h4 class="mb-3">Associated Mobiles ({{ $brand->mobiles->count() }})</h4>

        @if($brand->mobiles->isEmpty())
            <p>No mobiles associated with this brand.</p>
        @else
            <ul>
                @foreach($brand->mobiles as $mobile)
                    <li>{{ $mobile->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
