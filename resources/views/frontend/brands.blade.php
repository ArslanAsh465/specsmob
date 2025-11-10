@extends('frontend.layout.app')

@section('content')
    <div class="m-0 p-0">
        <h1 class="mb-4">Brands</h1>

        @if($brands->count() > 0)
            <div class="row g-3">
                @foreach($brands as $brand)
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 rounded-3 h-100 position-relative">
                            <h5 class="fw-bold mb-2">{{ $brand->name }}</h5>
                            <p class="mb-0 text-muted">
                                {{ $brand->mobiles->count() }} {{ Str::plural('Mobile', $brand->mobiles->count()) }}
                            </p>

                            <!-- Stretched link -->
                            <a href="{{ route('brand.show', $brand->slug) }}" class="stretched-link"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-muted">No brands found.</p>
        @endif
    </div>
@endsection
