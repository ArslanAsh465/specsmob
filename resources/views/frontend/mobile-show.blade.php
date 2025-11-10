@extends('frontend.layout.app')

@section('content')
<div class="container-fluid p-0">

    <!-- Mobile Image -->
    @php
        $defaultImage = asset('app-assets/images/no-image.png');
        $mobileImage = $mobile->image ? asset('storage/' . $mobile->image) : $defaultImage;
    @endphp

    <div class="card shadow-lg rounded-4 mb-4 border-0 overflow-hidden">
        <img src="{{ $mobileImage }}" class="card-img-top img-fluid" alt="{{ $mobile->name }}" style="object-fit: cover; max-height: 400px;">
    </div>

    <!-- Basic Info -->
    <div class="card shadow-lg rounded-4 mb-4 p-3 border-0 bg-light">
        <h1 class="fw-bold display-5 mb-3 text-primary">{{ $mobile->name }}</h1>
        <p class="text-muted mb-2">
            Brand: <a href="{{ route('brand.show', $mobile->brand->slug) }}" class="fw-semibold text-decoration-none text-primary">{{ $mobile->brand->name }}</a>
        </p>
        <p class="text-muted mb-2">Released: <span class="fw-medium">{{ $mobile->created_at->format('M d, Y') }}</span></p>
        @if($mobile->description)
            <p class="mt-3 fs-5">{{ $mobile->description }}</p>
        @endif
    </div>

    <!-- Specifications -->
    <div class="card shadow-lg rounded-4 mb-4 p-3 border-0 bg-white">
        <h2 class="fw-bold mb-4 text-secondary">Specifications</h2>
        <table class="table table-hover align-middle">
            <tbody>
                @php
                    $specs = [
                        'Network'         => $mobile->network_technology,
                        '2G Bands'        => $mobile->network_2g_bands,
                        '3G Bands'        => $mobile->network_3g_bands,
                        '4G Bands'        => $mobile->network_4g_bands,
                        '5G Bands'        => $mobile->network_5g_bands,
                        'Speed'           => $mobile->network_speed,
                        'Display'         => $mobile->display_size ? $mobile->display_size . ' (' . $mobile->display_type . ')' : null,
                        'Resolution'      => $mobile->display_resolution,
                        'Protection'      => $mobile->display_protection,
                        'OS / Chipset'    => $mobile->platform_os ? $mobile->platform_os . ' / ' . $mobile->platform_chipset : null,
                        'CPU / GPU'       => $mobile->platform_cpu ? $mobile->platform_cpu . ' / ' . $mobile->platform_gpu : null,
                        'Memory'          => $mobile->memory_internal ? $mobile->memory_internal . ' (' . ($mobile->memory_card_slot ?? 'No card slot') . ')' : null,
                        'Main Camera'     => $mobile->main_camera_setup ? $mobile->main_camera_setup . ' (' . $mobile->main_camera_features . ')' : null,
                        'Selfie Camera'   => $mobile->selfie_camera_setup ? $mobile->selfie_camera_setup . ' (' . $mobile->selfie_camera_features . ')' : null,
                        'Battery'         => $mobile->battery_type ? $mobile->battery_type . ' (' . $mobile->battery_charging . ')' : null,
                        'Sensors'         => $mobile->features_sensors,
                        'Colors'          => $mobile->misc_colors,
                        'Price'           => $mobile->misc_price,
                    ];
                @endphp

                @foreach($specs as $key => $value)
                    @if($value)
                        <tr class="table-light rounded">
                            <th class="fw-semibold text-primary" style="width: 35%;">{{ $key }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Comments Section -->
    <div class="card shadow-lg rounded-4 border-0 p-3 bg-light">
        <h2 class="fw-bold mb-4 text-secondary">Comments ({{ $mobile->comments->count() }})</h2>
        @if($mobile->comments->count() > 0)
            @foreach($mobile->comments as $comment)
                <div class="mb-4 p-3 rounded-3 bg-white shadow-sm">
                    <div class="d-flex justify-content-between mb-2">
                        <strong class="text-primary">{{ $comment->user->name ?? 'Guest' }}</strong>
                        @if($comment->stars)
                            <span class="text-warning fw-bold">{{ $comment->stars }} ⭐</span>
                        @endif
                    </div>
                    <p class="mb-2">{{ $comment->comment }}</p>
                    <small class="text-muted">{{ $comment->created_at->format('M d, Y H:i') }}</small>
                </div>
            @endforeach
        @else
            <p class="text-muted fs-5">No comments yet. Be the first to share your thoughts!</p>
        @endif
    </div>

</div>
@endsection
