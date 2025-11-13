@extends('frontend.layout.app')

@section('content')
    <!-- Page Header -->
    <div class="text-white text-center" style="background: url('{{ asset('app-assets/images/finder.jpg') }}') center center / cover no-repeat; height: 200px;">
        <div class="d-flex justify-content-center align-items-center bg-dark bg-opacity-50 w-100 h-100">
            <h1 class="fw-bold my-0">Phone Finder</h1>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mt-4">
        <form action="{{ route('phone.finder.results') }}" method="POST" class="row g-4 p-4">
            @csrf

            <!-- Brand -->
            <div class="col-md-6">
                <label for="brand" class="form-label fw-semibold">Brand</label>
                <select name="brand" id="brand" class="form-select">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Network -->
            <div class="col-md-6">
                <label for="network" class="form-label fw-semibold">Network</label>
                <select name="network" id="network" class="form-select">
                    <option value="">All Networks</option>
                    <option value="2G" {{ request('network') == '2G' ? 'selected' : '' }}>2G</option>
                    <option value="3G" {{ request('network') == '3G' ? 'selected' : '' }}>3G</option>
                    <option value="4G" {{ request('network') == '4G' ? 'selected' : '' }}>4G</option>
                    <option value="5G" {{ request('network') == '5G' ? 'selected' : '' }}>5G</option>
                </select>
            </div>

            <!-- Launch Year Slider -->
            <div class="col-md-6">
                <label class="form-label fw-semibold d-flex justify-content-between">
                    <span>Launch Year</span>
                    <span id="launch_year_display" class="text-primary fw-bold">
                        {{ request('launch_year_min', 2010) }} - {{ request('launch_year_max', now()->year) }}
                    </span>
                </label>
                <div id="launch_year_slider"></div>
                <input type="hidden" name="launch_year_min" id="launch_year_min" value="{{ request('launch_year_min', 2010) }}">
                <input type="hidden" name="launch_year_max" id="launch_year_max" value="{{ request('launch_year_max', now()->year) }}">
            </div>

            <!-- Price Slider -->
            <div class="col-md-6">
                <label class="form-label fw-semibold d-flex justify-content-between">
                    <span>Price ($)</span>
                    <span id="price_display" class="text-primary fw-bold">
                        {{ request('price_min', 50) }} - {{ request('price_max', 1000) }}
                    </span>
                </label>
                <div id="price_slider"></div>
                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min', 50) }}">
                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max', 1000) }}">
            </div>

            <!-- Operating System -->
            <div class="col-md-6">
                <label for="os" class="form-label fw-semibold">Operating System</label>
                <input type="text" name="os" id="os" class="form-control" placeholder="e.g. Android" value="{{ request('os') }}">
            </div>

            <!-- RAM -->
            <div class="col-md-6">
                <label for="ram" class="form-label fw-semibold">RAM</label>
                <select name="ram" id="ram" class="form-select">
                    <option value="">Any RAM</option>
                    <option value="2" {{ request('ram') == '2' ? 'selected' : '' }}>2 GB</option>
                    <option value="4" {{ request('ram') == '4' ? 'selected' : '' }}>4 GB</option>
                    <option value="6" {{ request('ram') == '6' ? 'selected' : '' }}>6 GB</option>
                    <option value="8" {{ request('ram') == '8' ? 'selected' : '' }}>8 GB</option>
                    <option value="12" {{ request('ram') == '12' ? 'selected' : '' }}>12 GB</option>
                </select>
            </div>

            <!-- Storage -->
            <div class="col-md-6">
                <label for="storage" class="form-label fw-semibold">Storage</label>
                <select name="storage" id="storage" class="form-select">
                    <option value="">Any Storage</option>
                    <option value="32" {{ request('storage') == '32' ? 'selected' : '' }}>32 GB</option>
                    <option value="64" {{ request('storage') == '64' ? 'selected' : '' }}>64 GB</option>
                    <option value="128" {{ request('storage') == '128' ? 'selected' : '' }}>128 GB</option>
                    <option value="256" {{ request('storage') == '256' ? 'selected' : '' }}>256 GB</option>
                    <option value="512" {{ request('storage') == '512' ? 'selected' : '' }}>512 GB</option>
                </select>
            </div>

            <!-- Color -->
            <div class="col-md-6">
                <label for="color" class="form-label fw-semibold">Color</label>
                <select name="color" id="color" class="form-select">
                    <option value="">Any Color</option>
                    <option value="Black" {{ request('color') == 'Black' ? 'selected' : '' }}>Black</option>
                    <option value="White" {{ request('color') == 'White' ? 'selected' : '' }}>White</option>
                    <option value="Blue" {{ request('color') == 'Blue' ? 'selected' : '' }}>Blue</option>
                    <option value="Red" {{ request('color') == 'Red' ? 'selected' : '' }}>Red</option>
                    <option value="Green" {{ request('color') == 'Green' ? 'selected' : '' }}>Green</option>
                </select>
            </div>

            <!-- Rating -->
            <div class="col-md-6">
                <label for="rating" class="form-label fw-semibold">Rating</label>
                <select name="rating" id="rating" class="form-select">
                    <option value="">Any Rating</option>
                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 ⭐</option>
                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 ⭐</option>
                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 ⭐</option>
                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 ⭐</option>
                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 ⭐</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg px-5">
                    <i class="bi bi-funnel-fill me-2"></i> Filter
                </button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <!-- Include noUiSlider CSS and JS from CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.0/nouislider.min.js"></script>

    <script>
        // Launch Year Slider
        var launchSlider = document.getElementById('launch_year_slider');
        noUiSlider.create(launchSlider, {
            start: [{{ request('launch_year_min', 2010) }}, {{ request('launch_year_max', now()->year) }}],
            connect: true,
            step: 1,
            range: { min: 2010, max: {{ now()->year }} },
            tooltips: [true, true],
            format: { to: value => parseInt(value), from: value => parseInt(value) }
        });
        launchSlider.noUiSlider.on('update', function(values) {
            document.getElementById('launch_year_min').value = values[0];
            document.getElementById('launch_year_max').value = values[1];
            document.getElementById('launch_year_display').textContent = values.join(' - ');
        });

        // Price Slider
        var priceSlider = document.getElementById('price_slider');
        noUiSlider.create(priceSlider, {
            start: [{{ request('price_min', 50) }}, {{ request('price_max', 1000) }}],
            connect: true,
            step: 50,
            range: { min: 50, max: 3000 },
            tooltips: [true, true],
            format: { to: value => parseInt(value), from: value => parseInt(value) }
        });
        priceSlider.noUiSlider.on('update', function(values) {
            document.getElementById('price_min').value = values[0];
            document.getElementById('price_max').value = values[1];
            document.getElementById('price_display').textContent = values.join(' - ');
        });
    </script>
@endsection
