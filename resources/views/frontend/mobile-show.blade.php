@extends('frontend.layout.app')

@section('content')
<div class="container-fluid p-0">

    @php
        $defaultImage = asset('app-assets/images/no-image.png');
        $mobileImage = $mobile->image_url ?? $defaultImage; // use image_url from your controller
    @endphp

    <!-- Main Card -->
    <div class="card border-0 shadow-lg rounded-4 mb-4 p-4" style="background-color:#f8f9fa;">
        <div class="row g-4 align-items-start">

            <!-- Left Column: Image -->
            <div class="col-lg-5 text-center">
                <div class="border rounded-4 shadow-sm p-2 bg-white">
                    <img src="{{ $mobileImage }}" alt="{{ $mobile->name }}" class="img-fluid rounded-3" style="max-height:450px; object-fit:cover;">
                </div>

                <!-- Compare / Pictures / Reviews / News Buttons -->
                <div class="d-flex justify-content-center flex-wrap gap-2 mt-4">
                    <a href="{{ route('compare', ['idPhone1' => $mobile->id]) }}" class="btn btn-outline-primary btn-sm" style="border-radius:20px;">
                        <i class="bi bi-shuffle me-1"></i> Compare
                    </a>
                    <a href="#pictures" class="btn btn-outline-success btn-sm" style="border-radius:20px;">
                        <i class="bi bi-images me-1"></i> Pictures
                    </a>
                    <a href="#reviews" class="btn btn-outline-secondary btn-sm" style="border-radius:20px;">
                        <i class="bi bi-chat-left-text me-1"></i> Reviews
                    </a>
                    <a href="#news" class="btn btn-outline-info btn-sm" style="border-radius:20px;">
                        <i class="bi bi-newspaper me-1"></i> News
                    </a>
                </div>
            </div>

            <!-- Right Column: Details -->
            <div class="col-lg-7">
                <!-- Title and Brand -->
                <div class="mb-4">
                    <h1 class="fw-bold display-6 text-primary mb-2">{{ $mobile->name }}</h1>
                    <p class="text-muted mb-1">
                        Brand:
                        <a href="{{ route('brand.show', $mobile->brand->slug) }}" class="fw-semibold text-decoration-none text-primary">
                            {{ $mobile->brand->name }}
                        </a>
                    </p>
                    <p class="text-muted mb-0">
                        Released: <span class="fw-medium">{{ $mobile->release_date ?? $mobile->created_at->format('M d, Y') }}</span>
                    </p>
                </div>

                <!-- Highlight Specs -->
                <div class="row text-center g-3 mb-4">
                    <div class="col-md-4 col-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <i class="bi bi-phone text-primary" style="font-size:20px;"></i><br>
                            <span class="fw-semibold">{{ $mobile->body_weight ?? '—' }}</span><br>
                            <small class="text-muted">Weight</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <i class="bi bi-android2 text-success" style="font-size:20px;"></i><br>
                            <span class="fw-semibold">{{ $mobile->platform_os ?? '—' }}</span><br>
                            <small class="text-muted">OS</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <i class="bi bi-cpu text-danger" style="font-size:20px;"></i><br>
                            <span class="fw-semibold">{{ $mobile->platform_chipset ?? '—' }}</span><br>
                            <small class="text-muted">Chipset</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <i class="bi bi-memory text-info" style="font-size:20px;"></i><br>
                            <span class="fw-semibold">{{ $mobile->memory_internal ?? '—' }}</span><br>
                            <small class="text-muted">Memory</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <i class="bi bi-battery-full text-warning" style="font-size:20px;"></i><br>
                            <span class="fw-semibold">{{ $mobile->battery_type ?? '—' }}</span><br>
                            <small class="text-muted">Battery</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-6">
                        <div class="p-3 border rounded-3 bg-white shadow-sm">
                            <i class="bi bi-camera text-purple" style="font-size:20px;"></i><br>
                            <span class="fw-semibold">{{ $mobile->main_camera_setup ?? '—' }}</span><br>
                            <small class="text-muted">Main Camera</small>
                        </div>
                    </div>
                </div>

                @if($mobile->description)
                    <p class="fs-6 text-secondary">{{ $mobile->description }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <ul class="nav nav-tabs mb-3" id="mobileTabs" role="tablist" style="border-radius:6px;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">Specifications</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pictures-tab" data-bs-toggle="tab" data-bs-target="#pictures" type="button" role="tab">Pictures</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">Reviews</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="news-tab" data-bs-toggle="tab" data-bs-target="#news" type="button" role="tab">News</button>
        </li>
    </ul>

    <div class="tab-content" id="mobileTabsContent">

        <!-- Specifications Tab -->
        <div class="tab-pane fade show active" id="specs" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white mb-4">
                <h4 class="fw-bold mb-4 text-secondary">Full Specifications</h4>
                <table class="table table-borderless table-hover align-middle">
                    <tbody>
                        @php
                            $specs = [
                                'Weight' => $mobile->body_weight,
                                'OS' => $mobile->platform_os,
                                'Chipset' => $mobile->platform_chipset,
                                'Memory' => $mobile->memory_internal,
                                'Battery' => $mobile->battery_type,
                                'Main Camera' => $mobile->main_camera_setup,
                                'Display' => $mobile->display_type,
                                'Resolution' => $mobile->display_resolution,
                                'Front Camera' => $mobile->selfie_camera ?? '—',
                                'Sensors' => $mobile->sensors ?? '—',
                            ];
                        @endphp

                        @foreach($specs as $key => $value)
                            @if($value)
                                <tr style="border-bottom:1px solid #f1f1f1;">
                                    <th class="fw-semibold text-primary" style="width:35%;">{{ $key }}</th>
                                    <td class="text-dark">{{ $value }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pictures Tab -->
        <div class="tab-pane fade" id="pictures" role="tabpanel">
            <div class="row g-3">
                <div class="col-12 text-center">
                    <img src="{{ $mobileImage }}" class="img-fluid rounded shadow-sm" alt="Mobile Image" style="max-width:300px;">
                    <p class="text-muted mt-2">No additional pictures available.</p>
                </div>
            </div>
        </div>

        <!-- Reviews Tab -->
        <div class="tab-pane fade" id="reviews" role="tabpanel">
            <div class="card border-0 shadow-sm rounded-4 p-3 mb-3">
                <h5 class="fw-bold mb-3">User Reviews ({{ $mobile->comments->count() }})</h5>
                @forelse($mobile->comments as $comment)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1 text-secondary">{{ $comment->comment }}</p>
                        @if($comment->stars)
                            @for($i=1;$i<=5;$i++)
                                <i class="bi {{ $i <= $comment->stars ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                            @endfor
                        @endif
                        <hr>
                    </div>
                @empty
                    <p class="text-muted">No reviews yet.</p>
                @endforelse
            </div>

            @auth
                <div class="card border-0 shadow-sm rounded-4 p-3">
                    <h5 class="fw-bold mb-3">Add Your Review</h5>
                    <form action="{{ route('ajax.comment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="comment_model" value="mobile">
                        <input type="hidden" name="mobile_id" value="{{ $mobile->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Rating:</label>
                            <div>
                                @for($i=1;$i<=5;$i++)
                                    <i class="bi bi-star star-rating me-1" data-value="{{ $i }}" style="cursor:pointer; font-size:1.3rem;"></i>
                                @endfor
                                <input type="hidden" name="stars" id="stars-value" value="1">
                            </div>
                        </div>

                        <textarea name="comment" class="form-control mb-3" rows="3" placeholder="Write your review..." required></textarea>
                        <button class="btn btn-primary btn-sm">Submit Review</button>
                    </form>
                </div>
            @else
                <p class="text-center">You must <a href="{{ route('login') }}">log in</a> to add a review.</p>
            @endauth
        </div>

        <!-- News Tab -->
        <div class="tab-pane fade" id="news" role="tabpanel">
            @if($mobile->news)
                <div class="card border-0 shadow-sm rounded-4 p-3 mb-3">
                    <h5 class="fw-semibold mb-1">{{ $mobile->news->title }}</h5>
                    <small class="text-muted">{{ $mobile->news->created_at->format('M d, Y') }}</small>
                    <p class="text-secondary mt-2 mb-0">{{ Str::limit($mobile->news->content, 200) }}</p>
                    <a href="{{ route('news.show', $mobile->news->slug) }}" class="text-primary fw-semibold">Read More →</a>
                </div>
            @else
                <p class="text-muted">No news article available for this model.</p>
            @endif
        </div>
    </div>
</div>
@endsection
