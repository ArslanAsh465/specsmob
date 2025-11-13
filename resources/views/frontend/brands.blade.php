@extends('frontend.layout.app')

@section('content')
    <!-- Page Header Section -->
    <div class="text-white text-center" style="background: url('{{ asset('app-assets/images/brands.jpg') }}') center center / cover no-repeat; height: 200px;">
        <div class="d-flex justify-content-center align-items-center bg-dark bg-opacity-50 w-100 h-100">
            <h1 class="fw-bold my-0">Brands</h1>
        </div>
    </div>

    <!-- Brands Listing Section -->
    <div class="mt-4">
        @if($brands->count() > 0)
            <div class="row g-4">
                @foreach($brands as $brand)
                    <div class="col-sm-6 col-md-4">
                        <div class="card border-0 text-center p-4 h-100 bg-light">
                            <a href="{{ route('brand.show', $brand->slug) }}" class="text-decoration-none text-dark">
                                <h5 class="fw-bold mb-2" style="transition: color 0.3s ease;" onmouseover="this.style.color='#f9a13d';" onmouseout="this.style.color='';">
                                    {{ $brand->name }}
                                </h5>
                            </a>

                            <p class="text-muted small mb-0">
                                {{ $brand->mobiles->count() }} {{ Str::plural('Mobile', $brand->mobiles->count()) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-muted">No brands found.</p>
        @endif
    </div>
@endsection
