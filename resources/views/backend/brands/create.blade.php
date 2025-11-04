@extends('backend.layout.app')

@if(!empty($title))
    @section('title', $title)
@endif

@section('header')
@endsection

@section('content')
    <!-- Page Header -->
    <div class="mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.brands.index') }}" class="text-decoration-none">Brands</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Add Brand</h1>
        </div>
    </div>

    <!-- Create Brand Form -->
    <div class="shadow-lg rounded bg-white p-3 mt-4">
        <form action="{{ route('backend.brands.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <!-- Brand Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Brand Name </label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter brand name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit Buttons -->
                <div class="col-12 mt-3">
                    <button class="btn btn-primary">Add Brand</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
@endsection
