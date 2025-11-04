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
                <li class="breadcrumb-item"><a href="{{ route('backend.users.index') }}" class="text-decoration-none">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">View User</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">{{ $user->name }}</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit User
                </a>
            </div>
        </div>
    </div>

    <!-- User Details -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <div class="row g-3">
            <div class="col-md-6">
                <strong>Name:</strong> {{ $user->name }}
            </div>
            <div class="col-md-6">
                <strong>Email:</strong> {{ $user->email }}
            </div>

            <div class="col-md-6">
                <strong>Email Verified:</strong> 
                @if($user->email_verified_at)
                    <span class="badge bg-success">Verified</span>
                @else
                    <span class="badge bg-danger">Not Verified</span>
                @endif
            </div>

            <div class="col-md-6">
                <strong>Status:</strong> 
                @if($user->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>

            <div class="col-md-6">
                <strong>Created:</strong> {{ $user->created_at->format('d M Y, h:i A') }}
            </div>

            <div class="col-md-6">
                <strong>Updated:</strong> {{ $user->updated_at->format('d M Y, h:i A') }}
            </div>
        </div>
    </div>
@endsection
