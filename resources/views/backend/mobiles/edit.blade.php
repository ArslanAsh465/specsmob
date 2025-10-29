@extends('backend.layout.app')

@if(!empty($title))
    @section('title', $title)
@endif

@section('content')
    <!-- Page Header -->
    <div class="mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.mobiles.index') }}" class="text-decoration-none">Mobiles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Mobile</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Edit Mobile</h1>
        </div>
    </div>

    <!-- Edit Mobile Form -->
    <div class="mt-4 shadow rounded p-3 bg-white">
        <form action="{{ route('backend.mobiles.update', $mobile->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Brand -->
                <div class="col-md-6">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ (old('brand_id', $mobile->brand_id) == $brand->id) ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Mobile Name -->
                <div class="col-md-6">
                    <label for="name" class="form-label">Mobile Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $mobile->name) }}" placeholder="Enter mobile name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Model Number -->
                <div class="col-md-6">
                    <label for="model_number" class="form-label">Model Number</label>
                    <input type="text" name="model_number" id="model_number" class="form-control @error('model_number') is-invalid @enderror" value="{{ old('model_number', $mobile->model_number) }}">
                    @error('model_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Release Date -->
                <div class="col-md-6">
                    <label for="release_date" class="form-label">Release Date</label>
                    <input type="date" name="release_date" id="release_date" class="form-control @error('release_date') is-invalid @enderror" value="{{ old('release_date', $mobile->release_date) }}">
                    @error('release_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- OS -->
                <div class="col-md-6">
                    <label for="os" class="form-label">Operating System</label>
                    <input type="text" name="os" id="os" class="form-control @error('os') is-invalid @enderror" value="{{ old('os', $mobile->os) }}">
                    @error('os')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Chipset -->
                <div class="col-md-6">
                    <label for="chipset" class="form-label">Chipset</label>
                    <input type="text" name="chipset" id="chipset" class="form-control @error('chipset') is-invalid @enderror" value="{{ old('chipset', $mobile->chipset) }}">
                    @error('chipset')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- RAM -->
                <div class="col-md-6">
                    <label for="ram" class="form-label">RAM</label>
                    <input type="text" name="ram" id="ram" class="form-control @error('ram') is-invalid @enderror" value="{{ old('ram', $mobile->ram) }}">
                    @error('ram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Storage -->
                <div class="col-md-6">
                    <label for="storage" class="form-label">Storage</label>
                    <input type="text" name="storage" id="storage" class="form-control @error('storage') is-invalid @enderror" value="{{ old('storage', $mobile->storage) }}">
                    @error('storage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Display -->
                <div class="col-md-6">
                    <label for="display" class="form-label">Display</label>
                    <input type="text" name="display" id="display" class="form-control @error('display') is-invalid @enderror" value="{{ old('display', $mobile->display) }}">
                    @error('display')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Resolution -->
                <div class="col-md-6">
                    <label for="resolution" class="form-label">Resolution</label>
                    <input type="text" name="resolution" id="resolution" class="form-control @error('resolution') is-invalid @enderror" value="{{ old('resolution', $mobile->resolution) }}">
                    @error('resolution')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Camera Rear -->
                <div class="col-md-6">
                    <label for="camera_rear" class="form-label">Rear Camera</label>
                    <input type="text" name="camera_rear" id="camera_rear" class="form-control @error('camera_rear') is-invalid @enderror" value="{{ old('camera_rear', $mobile->camera_rear) }}">
                    @error('camera_rear')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Camera Front -->
                <div class="col-md-6">
                    <label for="camera_front" class="form-label">Front Camera</label>
                    <input type="text" name="camera_front" id="camera_front" class="form-control @error('camera_front') is-invalid @enderror" value="{{ old('camera_front', $mobile->camera_front) }}">
                    @error('camera_front')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Battery -->
                <div class="col-md-6">
                    <label for="battery" class="form-label">Battery</label>
                    <input type="text" name="battery" id="battery" class="form-control @error('battery') is-invalid @enderror" value="{{ old('battery', $mobile->battery) }}">
                    @error('battery')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Charging -->
                <div class="col-md-6">
                    <label for="charging" class="form-label">Charging</label>
                    <input type="text" name="charging" id="charging" class="form-control @error('charging') is-invalid @enderror" value="{{ old('charging', $mobile->charging) }}">
                    @error('charging')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Colors -->
                <div class="col-md-6">
                    <label for="colors" class="form-label">Colors</label>
                    <input type="text" name="colors" id="colors" class="form-control @error('colors') is-invalid @enderror" value="{{ old('colors', $mobile->colors) }}">
                    @error('colors')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $mobile->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="1" {{ (old('status', $mobile->status) == '1') ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (old('status', $mobile->status) == '0') ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $mobile->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-3">
                    <button class="btn btn-primary">Update Mobile</button>
                </div>
            </div>
        </form>
    </div>
@endsection
