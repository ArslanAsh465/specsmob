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
                <li class="breadcrumb-item"><a href="{{ route('backend.managers.index') }}" class="text-decoration-none">Managers</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Manager</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">{{ $manager->name }}</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.managers.edit', $manager->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Manager
                </a>
            </div>
        </div>
    </div>

    <!-- Manager Details -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Name:</strong> {{ $manager->name }}
            </div>
            <div class="col-md-6">
                <strong>Email:</strong> {{ $manager->email }}
            </div>

            <div class="col-md-6">
                <strong>Email Verified:</strong> 
                @if($manager->email_verified_at)
                    <span class="badge bg-success">Verified</span>
                @else
                    <span class="badge bg-danger">Not Verified</span>
                @endif
            </div>

            <div class="col-md-6">
                <strong>Status:</strong> 
                @if($manager->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>

            <div class="col-md-6">
                <strong>Created:</strong> {{ $manager->created_at->format('d M Y, h:i A') }}
            </div>

            <div class="col-md-6">
                <strong>Updated:</strong> {{ $manager->updated_at->format('d M Y, h:i A') }}
            </div>
        </div>
    </div>
@endsection
