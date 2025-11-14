@extends('frontend.layout.app')

@section('content')
    @php
        $noImage = asset('app-assets/images/no-image.png');
    @endphp

    <div class="m-0 p-0">
        <!-- Latest Reviews -->
        <div class="mb-4">
            <div class="row g-3">
                @if(count($latestReviews) >= 3)
                    <!-- Left big card -->
                    <div class="col-12 col-lg-6">
                        <a href="{{ route('review.show', $latestReviews[0]->slug) }}" class="text-decoration-none d-block" style="height: 300px;">
                            <div class="card text-white h-100">
                                <div class="card-img-overlay p-0 d-flex flex-column justify-content-between" style="background: url('{{ $latestReviews[0]->image ? asset('storage/' . $latestReviews[0]->image) : $noImage }}') center/cover no-repeat;">
                                    
                                    <!-- Top overlay -->
                                    <div class="d-flex justify-content-end p-2" style="background: rgba(0,0,0,0.4);">
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-chat-left-text"></i> {{ $latestReviews[0]->comments_count ?? 0 }}
                                        </span>
                                    </div>

                                    <!-- Bottom overlay -->
                                    <div class="p-3" style="background: rgba(0,0,0,0.4);">
                                        <h5 class="card-title mb-1">{{ $latestReviews[0]->title }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Right stacked cards -->
                    <div class="col-12 col-lg-6 d-flex flex-column gap-3">
                        @foreach($latestReviews->slice(1,2) as $review)
                            <a href="{{ route('review.show', $review->slug) }}" class="text-decoration-none d-block" style="height: 140px;">
                                <div class="card text-white h-100">
                                    <div class="card-img-overlay p-0 d-flex flex-column justify-content-between" 
                                        style="background: url('{{ $review->image ? asset('storage/' . $review->image) : $noImage }}') center/cover no-repeat;">
                                        
                                        <!-- Top overlay -->
                                        <div class="d-flex justify-content-end p-2" style="background: rgba(0,0,0,0.4);">
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-chat-left-text"></i> {{ $review->comments_count ?? 0 }}
                                            </span>
                                        </div>

                                        <!-- Bottom overlay -->
                                        <div class="p-3" style="background: rgba(0,0,0,0.4);">
                                            <h5 class="card-title mb-1">{{ $review->title }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-center">No latest reviews available.</p>
                @endif
            </div>
        </div>

        <!-- Latest News -->
        <div class="mb-4">
            <div class="row g-3">
                @if(count($latestNews) >= 3)
                    <!-- Left big card -->
                    <div class="col-12 col-lg-6">
                        <a href="{{ route('review.show', $latestNews[0]->slug) }}" class="text-decoration-none d-block" style="height: 300px;">
                            <div class="card text-white h-100">
                                <div class="card-img-overlay p-0 d-flex flex-column justify-content-between" 
                                    style="background: url('{{ $latestNews[0]->image ? asset('storage/' . $latestNews[0]->image) : $noImage }}') center/cover no-repeat; background-size: cover;">
                                    
                                    <!-- Top overlay -->
                                    <div class="d-flex justify-content-end p-2" style="background: rgba(0,0,0,0.4);">
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-chat-left-text"></i> {{ $latestNews[0]->comments_count ?? 0 }}
                                        </span>
                                    </div>

                                    <!-- Bottom overlay -->
                                    <div class="p-3" style="background: rgba(0,0,0,0.4);">
                                        <h5 class="card-title mb-1">{{ $latestNews[0]->title }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Right stacked cards -->
                    <div class="col-12 col-lg-6 d-flex flex-column gap-3">
                        @foreach($latestNews->slice(1,2) as $news)
                            <a href="{{ route('review.show', $news->slug) }}" class="text-decoration-none d-block" style="height: 140px;">
                                <div class="card text-white h-100">
                                    <div class="card-img-overlay p-0 d-flex flex-column justify-content-between" 
                                        style="background: url('{{ $news->image ? asset('storage/' . $news->image) : $noImage }}') center/cover no-repeat; background-size: cover;">
                                        
                                        <!-- Top overlay -->
                                        <div class="d-flex justify-content-end p-2" style="background: rgba(0,0,0,0.4);">
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-chat-left-text"></i> {{ $news->comments_count ?? 0 }}
                                            </span>
                                        </div>

                                        <!-- Bottom overlay -->
                                        <div class="p-3" style="background: rgba(0,0,0,0.4);">
                                            <h5 class="card-title mb-1">{{ $news->title }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-center">No latest news available.</p>
                @endif
            </div>
        </div>

        <!-- Top 10 News -->
        <div class="mb-4">
            <h4 class="mb-3">Top News</h4>
            @if($topNews->count() > 0)
                @foreach($topNews as $news)
                    <a href="{{ route('review.show', $news->slug) }}" class="text-decoration-none d-block mb-3">
                        <div class="card h-100 text-dark">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $news->image ? asset('storage/' . $news->image) : $noImage }}" class="img-fluid rounded-start" alt="{{ $news->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card h-100 d-flex flex-column border-0">
                                        <div class="card-body flex-grow-1">
                                            <h2 class="card-title">{{ $news->title }}</h2>
                                            <p class="card-text">{{ Str::limit($news->body, 150) }}</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end align-items-center">
                                            <small class="text-muted me-3">
                                                <i class="bi bi-clock"></i> {{ $news->created_at->diffForHumans() }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-chat-left-text"></i> {{ $news->comments_count ?? 0 }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p>No top news available.</p>
            @endif
        </div>

        <!-- Top 10 Reviews -->
        <div class="mb-4">
            <h4 class="mb-3">Top Reviews</h4>
            @if($topReviews->count() > 0)
                @foreach($topReviews as $review)
                    <a href="{{ route('review.show', $review->slug) }}" class="text-decoration-none d-block mb-3">
                        <div class="card h-100 text-dark">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $review->image ? asset('storage/' . $review->image) : $noImage }}" 
                                        class="img-fluid rounded-start" 
                                        alt="{{ $review->title }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="card h-100 d-flex flex-column border-0">
                                        <div class="card-body flex-grow-1">
                                            <h5 class="card-title">{{ $review->title }}</h5>
                                            <p class="card-text">{{ Str::limit($review->description, 100) }}</p>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end align-items-center">
                                            <small class="text-muted me-3">
                                                <i class="bi bi-clock"></i> {{ $review->created_at->diffForHumans() }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-chat-left-text"></i> {{ $review->comments_count ?? 0 }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                <p>No top reviews available.</p>
            @endif
        </div>

    </div>
@endsection
