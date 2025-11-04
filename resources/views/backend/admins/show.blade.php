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
                <li class="breadcrumb-item"><a href="{{ route('backend.admins.index') }}" class="text-decoration-none">Admins</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Admin</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">{{ $admin->name }}</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.admins.edit', $admin->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Admin
                </a>
            </div>
        </div>
    </div>

    <!-- Admin Details -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Name:</strong> {{ $admin->name }}
            </div>
            <div class="col-md-6">
                <strong>Email:</strong> {{ $admin->email }}
            </div>

            <div class="col-md-6">
                <strong>Email Verified:</strong> 
                @if($admin->email_verified_at)
                    <span class="badge bg-success">Verified</span>
                @else
                    <span class="badge bg-danger">Not Verified</span>
                @endif
            </div>

            <div class="col-md-6">
                <strong>Status:</strong> 
                @if($admin->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">In-Active</span>
                @endif
            </div>

            <div class="col-md-6">
                <strong>Created:</strong> {{ $admin->created_at->format('d M Y, h:i A') }}
            </div>

            <div class="col-md-6">
                <strong>Updated:</strong> {{ $admin->updated_at->format('d M Y, h:i A') }}
            </div>
        </div>
    </div>
@endsection
