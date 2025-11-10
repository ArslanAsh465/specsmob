@extends('frontend.layout.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">News</h1>

    @if($news->count() > 0)
        <div class="list-group">

            @php
                $defaultImage = asset('app-assets/images/no-image.png');
            @endphp

            @foreach($news as $item)
                @php
                    $image = $item->image ? asset('storage/' . $item->image) : $defaultImage;
                @endphp

                <div class="list-group-item list-group-item-action mb-3 p-3">
                    <div class="row g-3 align-items-center">
                        {{-- Image --}}
                        <div class="col-md-3 col-12">
                            <img src="{{ $image }}" class="img-fluid rounded" alt="{{ $item->title }}" style="height: 150px; width: 100%; object-fit: cover;">
                        </div>

                        {{-- Title & Info --}}
                        <div class="col-md-9 col-12">
                            <h5 class="mb-1">
                                <a href="{{ route('news.show', $item->id) }}" class="text-decoration-none text-dark">
                                    {{ $item->title }}
                                </a>
                            </h5>
                            <div class="text-muted mb-2">
                                {{ $item->created_at->format('M d, Y H:i') }}
                                @if(property_exists($item, 'comments_count') && $item->comments_count)
                                    | <i class="bi bi-chat-left-text me-1"></i> {{ $item->comments_count }} Comments
                                @endif
                            </div>
                            @if(!empty($item->excerpt))
                                <p class="mb-0">{{ Str::limit($item->excerpt, 150) }}</p>
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        {{-- Bootstrap Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $news->links('pagination::bootstrap-5') }}
        </div>

    @else
        <p class="text-muted">No news found.</p>
    @endif
</div>
@endsection
