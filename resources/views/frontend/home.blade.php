@extends('frontend.layout.app')

@section('content')
<div class="container my-4">

    {{-- Devices Section --}}
    <div class="row g-3 mb-5">
        {{-- Left Column: Big Card --}}
        <div class="col-md-8">
            @if(isset($latestDevices[0]))
                @php
                    $deviceImage = $latestDevices[0]->image ? asset('storage/' . $latestDevices[0]->image) : asset('images/no-image.png');
                @endphp
                <div class="card text-white position-relative" style="height: 300px;">
                    <img src="{{ $deviceImage }}" class="card-img h-100" style="object-fit: cover;" alt="{{ $latestDevices[0]->name }}">
                    
                    {{-- Overlay --}}
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(128,128,128,0.4);"></div>

                    {{-- Top info --}}
                    <div class="position-absolute top-0 start-0 w-100 p-2 d-flex justify-content-between">
                        <span class="badge bg-secondary">{{ $latestDevices[0]->created_at->format('M d, Y') }}</span>
                        <span class="badge bg-secondary">
                            <i class="bi bi-chat-left-text me-1"></i> {{ $latestDevices[0]->comments_count ?? 0 }}
                        </span>
                    </div>

                    {{-- Bottom Text --}}
                    <div class="card-body position-absolute bottom-0 start-0 w-100 p-2">
                        <h5 class="card-title mb-0">{{ $latestDevices[0]->name }}</h5>
                    </div>
                </div>
            @endif
        </div>

        {{-- Right Column: Two Stacked Small Cards, dynamic height --}}
        <div class="col-md-4 d-flex flex-column" style="height: 300px;">
            @for($i = 1; $i <= 2; $i++)
                @php
                    $deviceImage = isset($latestDevices[$i]) && $latestDevices[$i]->image
                        ? asset('storage/' . $latestDevices[$i]->image)
                        : asset('images/no-image.png');
                @endphp
                <div class="card text-white position-relative flex-fill mb-3">
                    <img src="{{ $deviceImage }}" class="card-img h-100" style="object-fit: cover;" alt="{{ $latestDevices[$i]->name ?? 'No Device' }}">
                    
                    {{-- Overlay --}}
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(128,128,128,0.4);"></div>

                    {{-- Top info --}}
                    @if(isset($latestDevices[$i]))
                        <div class="position-absolute top-0 start-0 w-100 p-2 d-flex justify-content-between">
                            <span class="badge bg-secondary">{{ $latestDevices[$i]->created_at->format('M d, Y') }}</span>
                            <span class="badge bg-secondary">
                                <i class="bi bi-chat-left-text me-1"></i> {{ $latestDevices[$i]->comments_count ?? 0 }}
                            </span>
                        </div>
                    @endif

                    {{-- Bottom Text --}}
                    <div class="card-body position-absolute bottom-0 start-0 w-100 p-2">
                        @if(isset($latestDevices[$i]))
                            <h6 class="card-title mb-0">{{ $latestDevices[$i]->name }}</h6>
                        @else
                            <p class="text-muted mb-0">No Device</p>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {{-- Reviews Section --}}
    <div class="row g-3">
        {{-- Left Column: Big Card --}}
        <div class="col-md-8">
            @if(isset($latestReviews[0]))
                @php
                    $reviewImage = $latestReviews[0]->image ? asset('storage/' . $latestReviews[0]->image) : asset('images/no-image.png');
                @endphp
                <div class="card text-white position-relative" style="height: 300px;">
                    <img src="{{ $reviewImage }}" class="card-img h-100" style="object-fit: cover;" alt="{{ $latestReviews[0]->title }}">
                    
                    {{-- Overlay --}}
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(128,128,128,0.4);"></div>

                    {{-- Top info --}}
                    <div class="position-absolute top-0 start-0 w-100 p-2 d-flex justify-content-between">
                        <span class="badge bg-secondary">{{ $latestReviews[0]->created_at->format('M d, Y') }}</span>
                        <span class="badge bg-secondary">
                            <i class="bi bi-chat-left-text me-1"></i> {{ $latestReviews[0]->comments_count ?? 0 }}
                        </span>
                    </div>

                    {{-- Bottom Text --}}
                    <div class="card-body position-absolute bottom-0 start-0 w-100 p-2">
                        <h5 class="card-title mb-0">{{ $latestReviews[0]->title }}</h5>
                    </div>
                </div>
            @endif
        </div>

        {{-- Right Column: Two Stacked Small Cards, dynamic height --}}
        <div class="col-md-4 d-flex flex-column" style="height: 300px;">
            @for($i = 1; $i <= 2; $i++)
                @php
                    $reviewImage = isset($latestReviews[$i]) && $latestReviews[$i]->image
                        ? asset('storage/' . $latestReviews[$i]->image)
                        : asset('images/no-image.png');
                @endphp
                <div class="card text-white position-relative flex-fill mb-3">
                    <img src="{{ $reviewImage }}" class="card-img h-100" style="object-fit: cover;" alt="{{ $latestReviews[$i]->title ?? 'No Review' }}">
                    
                    {{-- Overlay --}}
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(128,128,128,0.4);"></div>

                    {{-- Top info --}}
                    @if(isset($latestReviews[$i]))
                        <div class="position-absolute top-0 start-0 w-100 p-2 d-flex justify-content-between">
                            <span class="badge bg-secondary">{{ $latestReviews[$i]->created_at->format('M d, Y') }}</span>
                            <span class="badge bg-secondary">
                                <i class="bi bi-chat-left-text me-1"></i> {{ $latestReviews[$i]->comments_count ?? 0 }}
                            </span>
                        </div>
                    @endif

                    {{-- Bottom Text --}}
                    <div class="card-body position-absolute bottom-0 start-0 w-100 p-2">
                        @if(isset($latestReviews[$i]))
                            <h6 class="card-title mb-0">{{ $latestReviews[$i]->title }}</h6>
                        @else
                            <p class="text-muted mb-0">No Review</p>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>

</div>
@endsection
