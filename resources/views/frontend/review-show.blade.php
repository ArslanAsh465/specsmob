@extends('frontend.layout.app')

@section('content')
    @php
        $defaultImage = asset('app-assets/images/no-image.png');
        $image = $review->image ? asset('storage/' . $review->image) : $defaultImage;
    @endphp

    <!-- Top Image -->
    <div class="mb-4">
        <img src="{{ $image }}" alt="{{ $review->title }}" class="img-fluid w-100 rounded shadow-sm" style="max-height: 450px; object-fit: cover;">
    </div>

    <!-- News Content Card -->
    <div class="card border-0 shadow-sm rounded overflow-hidden mb-4">
        <!-- Header -->
        <div class="card-header bg-light">
            <h3 class="mb-0">{{ $review->title }}</h3>
            <small class="d-flex justify-content-between mt-1 text-muted">
                <span>
                    <i class="bi bi-calendar3 me-1"></i> {{ $review->created_at->diffForHumans() }}
                </span>
                <span>
                    <i class="bi bi-chat-left-text me-1"></i> {{ $review->comments->count() }} Comments
                </span>
            </small>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="text-secondary" style="line-height: 1.8;">
                {!! $review->body !!}
            </div>
        </div>
    </div>

    <!-- Comments Card -->
    <div class="card border-0 shadow-sm rounded overflow-hidden mb-4">
        <div class="card-header bg-light">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-chat-left-text me-1"></i> Comments ({{ $review->comments->count() }})
            </h5>
        </div>

        <div class="card-body">
            @if($review->comments->isNotEmpty())
                @foreach($review->comments as $comment)
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>

                        <p class="mb-2 text-secondary">{{ $comment->comment }}</p>

                        @if($comment->stars)
                            <div class="small mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $comment->stars ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                                @endfor
                            </div>
                        @endif
                    </div>

                    @if(!$loop->last)
                        <hr class="mb-3">
                    @endif
                @endforeach
            @else
                <p class="text-muted mb-0">No comments yet. Be the first to comment!</p>
            @endif
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded overflow-hidden mb-4">
        <div class="card-header bg-light">
            <h5 class="fw-bold mb-0">Add Your Comment</h5>
        </div>

        <div class="card-body">
            @auth
                <form id="comment-form" action="{{ route('ajax.comment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="comment_model" value="news">
                    <input type="hidden" name="news_id" value="{{ $review->id }}">

                    <!-- Star Rating -->
                    <div class="mb-3 d-flex align-items-center">
                        <label class="form-label fw-bold me-2 mb-0">Rating:</label>
                        <div class="d-flex align-items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star star-rating me-1" data-value="{{ $i }}" style="cursor:pointer; font-size:1.2rem;"></i>
                            @endfor
                            <input type="hidden" name="stars" id="stars-value" value="1">
                        </div>
                    </div>

                    <!-- Comment Textarea -->
                    <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-sm btn-primary">Submit Comment</button>
                </form>
            @else
                <p class="mb-0 text-center">
                    You must <a href="{{ route('login') }}">log in</a> to add a comment.
                </p>
            @endauth
        </div>
    </div>
@endsection

@section('footer')
    <script>
        const stars = document.querySelectorAll('.star-rating');
        const starsValueInput = document.getElementById('stars-value');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = parseInt(star.getAttribute('data-value'));
                starsValueInput.value = value;

                stars.forEach(s => {
                    const starValue = parseInt(s.getAttribute('data-value'));
                    if (starValue <= value) {
                        // Filled star
                        s.classList.add('bi-star-fill', 'text-warning');
                        s.classList.remove('bi-star', 'text-muted');
                    } else {
                        // Empty star
                        s.classList.add('bi-star', 'text-muted');
                        s.classList.remove('bi-star-fill', 'text-warning');
                    }
                });
            });
        });

        // Initialize stars as empty
        stars.forEach(s => {
            s.classList.add('bi-star', 'text-muted');
        });
    </script>
@endsection
