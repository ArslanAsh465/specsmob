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
                <li class="breadcrumb-item"><a href="{{ route('backend.mobiles.index') }}" class="text-decoration-none">Mobiles</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Mobile</li>
            </ol>
        </nav>

        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-9">
                <h1 class="h3 mb-0">{{ $mobile->name }}</h1>
            </div>

            <div class="col-md-3 text-end">
                <a href="{{ route('backend.mobiles.edit', $mobile->id) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Mobile
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Details -->
    <div class="shadow rounded bg-white p-3 mb-4">
        <div class="row g-3">

            <!-- General Info -->
            <div class="col-md-6"><strong>Brand:</strong> {{ $mobile->brand->name ?? '-' }}</div>
            <div class="col-md-6"><strong>Slug:</strong> {{ $mobile->slug }}</div>
            <div class="col-md-6"><strong>Model Number:</strong> {{ $mobile->model_number ?? '-' }}</div>
            <div class="col-md-6"><strong>Release Date:</strong> {{ $mobile->release_date ?? '-' }}</div>
            <div class="col-md-6"><strong>Status:</strong>
                @if($mobile->status)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>
            <div class="col-md-6"><strong>Views:</strong> {{ $mobile->views }}</div>

            <!-- Network -->
            <div class="col-12"><h5 class="mt-3">Network</h5></div>
            <div class="col-md-6"><strong>Technology:</strong> {{ $mobile->network_technology ?? '-' }}</div>
            <div class="col-md-6"><strong>2G Bands:</strong> {{ $mobile->network_2g_bands ?? '-' }}</div>
            <div class="col-md-6"><strong>3G Bands:</strong> {{ $mobile->network_3g_bands ?? '-' }}</div>
            <div class="col-md-6"><strong>4G Bands:</strong> {{ $mobile->network_4g_bands ?? '-' }}</div>
            <div class="col-md-6"><strong>5G Bands:</strong> {{ $mobile->network_5g_bands ?? '-' }}</div>
            <div class="col-md-6"><strong>Speed:</strong> {{ $mobile->network_speed ?? '-' }}</div>

            <!-- Body -->
            <div class="col-12"><h5 class="mt-3">Body</h5></div>
            <div class="col-md-6"><strong>Dimensions:</strong> {{ $mobile->body_dimensions ?? '-' }}</div>
            <div class="col-md-6"><strong>Weight:</strong> {{ $mobile->body_weight ?? '-' }}</div>
            <div class="col-md-6"><strong>Build:</strong> {{ $mobile->body_build ?? '-' }}</div>
            <div class="col-md-6"><strong>SIM:</strong> {{ $mobile->body_sim ?? '-' }}</div>

            <!-- Display -->
            <div class="col-12"><h5 class="mt-3">Display</h5></div>
            <div class="col-md-6"><strong>Type:</strong> {{ $mobile->display_type ?? '-' }}</div>
            <div class="col-md-6"><strong>Size:</strong> {{ $mobile->display_size ?? '-' }}</div>
            <div class="col-md-6"><strong>Resolution:</strong> {{ $mobile->display_resolution ?? '-' }}</div>
            <div class="col-md-6"><strong>Protection:</strong> {{ $mobile->display_protection ?? '-' }}</div>

            <!-- Platform -->
            <div class="col-12"><h5 class="mt-3">Platform</h5></div>
            <div class="col-md-6"><strong>OS:</strong> {{ $mobile->platform_os ?? '-' }}</div>
            <div class="col-md-6"><strong>Chipset:</strong> {{ $mobile->platform_chipset ?? '-' }}</div>
            <div class="col-md-6"><strong>CPU:</strong> {{ $mobile->platform_cpu ?? '-' }}</div>
            <div class="col-md-6"><strong>GPU:</strong> {{ $mobile->platform_gpu ?? '-' }}</div>

            <!-- Memory -->
            <div class="col-12"><h5 class="mt-3">Memory</h5></div>
            <div class="col-md-6"><strong>Card Slot:</strong> {{ $mobile->memory_card_slot ?? '-' }}</div>
            <div class="col-md-6"><strong>Internal:</strong> {{ $mobile->memory_internal ?? '-' }}</div>

            <!-- Cameras -->
            <div class="col-12"><h5 class="mt-3">Cameras</h5></div>
            <div class="col-md-6"><strong>Main Setup:</strong> {{ $mobile->main_camera_setup ?? '-' }}</div>
            <div class="col-md-6"><strong>Main Features:</strong> {{ $mobile->main_camera_features ?? '-' }}</div>
            <div class="col-md-6"><strong>Main Video:</strong> {{ $mobile->main_camera_video ?? '-' }}</div>
            <div class="col-md-6"><strong>Selfie Setup:</strong> {{ $mobile->selfie_camera_setup ?? '-' }}</div>
            <div class="col-md-6"><strong>Selfie Features:</strong> {{ $mobile->selfie_camera_features ?? '-' }}</div>
            <div class="col-md-6"><strong>Selfie Video:</strong> {{ $mobile->selfie_camera_video ?? '-' }}</div>

            <!-- Battery -->
            <div class="col-12"><h5 class="mt-3">Battery</h5></div>
            <div class="col-md-6"><strong>Type:</strong> {{ $mobile->battery_type ?? '-' }}</div>
            <div class="col-md-6"><strong>Charging:</strong> {{ $mobile->battery_charging ?? '-' }}</div>

            <!-- Misc -->
            <div class="col-12"><h5 class="mt-3">Misc</h5></div>
            <div class="col-md-6"><strong>Colors:</strong> {{ $mobile->misc_colors ?? '-' }}</div>
            <div class="col-md-6"><strong>Models:</strong> {{ $mobile->misc_models ?? '-' }}</div>
            <div class="col-md-6"><strong>SAR US Head:</strong> {{ $mobile->misc_sar_us_head ?? '-' }}</div>
            <div class="col-md-6"><strong>SAR US Body:</strong> {{ $mobile->misc_sar_us_body ?? '-' }}</div>
            <div class="col-md-6"><strong>SAR EU Head:</strong> {{ $mobile->misc_sar_eu_head ?? '-' }}</div>
            <div class="col-md-6"><strong>SAR EU Body:</strong> {{ $mobile->misc_sar_eu_body ?? '-' }}</div>
            <div class="col-md-6"><strong>Price:</strong> {{ $mobile->misc_price ? '$' . number_format($mobile->misc_price, 2) : '-' }}</div>

            <!-- Description -->
            <div class="col-12"><h5 class="mt-3">Description</h5></div>
            <div class="col-12">{{ $mobile->description ?? '-' }}</div>

            <!-- SEO -->
            <div class="col-12"><h5 class="mt-3">SEO</h5></div>
            <div class="col-md-6"><strong>Meta Title:</strong> {{ $mobile->meta_title ?? '-' }}</div>
            <div class="col-md-6"><strong>Meta Keywords:</strong> {{ $mobile->meta_keywords ?? '-' }}</div>
            <div class="col-12"><strong>Meta Description:</strong> {{ $mobile->meta_description ?? '-' }}</div>
            <div class="col-12"><strong>Canonical URL:</strong> {{ $mobile->canonical_url ?? '-' }}</div>
            <div class="col-md-6"><strong>OG Title:</strong> {{ $mobile->og_title ?? '-' }}</div>
            <div class="col-12"><strong>OG Description:</strong> {{ $mobile->og_description ?? '-' }}</div>
            <div class="col-12"><strong>OG Image:</strong> 
                @if($mobile->og_image)
                    <img src="{{ asset($mobile->og_image) }}" alt="OG Image" class="img-fluid mt-1" style="max-height: 200px;">
                @else
                    -
                @endif
            </div>
        </div>
    </div>
@endsection
