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

        <!-- Availability -->
        <div class="col-md-6">
            <label for="availability" class="form-label fw-semibold">Availability</label>
            <select name="availability" id="availability" class="form-select">
                <option value="">Any</option>
                <option value="Available" {{ request('availability') == 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Coming soon" {{ request('availability') == 'Coming soon' ? 'selected' : '' }}>Coming Soon</option>
                <option value="Discontinued" {{ request('availability') == 'Discontinued' ? 'selected' : '' }}>Discontinued</option>
            </select>
        </div>

        <!-- Price Slider -->
        <div class="col-md-6">
            <label class="form-label fw-semibold d-flex justify-content-between">
                <span>Price ($)</span>
                <span id="price_display" class="text-primary fw-bold">
                    {{ request('price_min', 50) }} - {{ request('price_max', 3000) }}
                </span>
            </label>
            <div id="price_slider"></div>
            <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min', 50) }}">
            <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max', 3000) }}">
        </div>

        <!-- Dual SIM -->
        <div class="col-md-6">
            <label for="dual_sim" class="form-label fw-semibold">Dual SIM</label>
            <select name="dual_sim" id="dual_sim" class="form-select">
                <option value="">Any</option>
                <option value="Yes" {{ request('dual_sim') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ request('dual_sim') == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- eSIM -->
        <div class="col-md-6">
            <label for="esim" class="form-label fw-semibold">eSIM</label>
            <select name="esim" id="esim" class="form-select">
                <option value="">Any</option>
                <option value="Yes" {{ request('esim') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ request('esim') == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Display Size -->
        <div class="col-md-6">
            <label for="display_size" class="form-label fw-semibold">Display Size (inches)</label>
            <input type="text" name="display_size" id="display_size" class="form-control" value="{{ request('display_size') }}">
        </div>

        <!-- Network Bands -->
        <div class="col-md-3">
            <label for="network_2g" class="form-label fw-semibold">2G</label>
            <input type="text" name="network_2g" id="network_2g" class="form-control" value="{{ request('network_2g') }}">
        </div>
        <div class="col-md-3">
            <label for="network_3g" class="form-label fw-semibold">3G</label>
            <input type="text" name="network_3g" id="network_3g" class="form-control" value="{{ request('network_3g') }}">
        </div>
        <div class="col-md-3">
            <label for="network_4g" class="form-label fw-semibold">4G</label>
            <input type="text" name="network_4g" id="network_4g" class="form-control" value="{{ request('network_4g') }}">
        </div>
        <div class="col-md-3">
            <label for="network_5g" class="form-label fw-semibold">5G</label>
            <input type="text" name="network_5g" id="network_5g" class="form-control" value="{{ request('network_5g') }}">
        </div>

        <!-- OS & Chipset -->
        <div class="col-md-6">
            <label for="platform_os" class="form-label fw-semibold">Operating System</label>
            <input type="text" name="platform_os" id="platform_os" class="form-control" value="{{ request('platform_os') }}">
        </div>
        <div class="col-md-6">
            <label for="platform_chipset" class="form-label fw-semibold">Chipset</label>
            <input type="text" name="platform_chipset" id="platform_chipset" class="form-control" value="{{ request('platform_chipset') }}">
        </div>

        <!-- Resolution & RAM/ROM -->
        <div class="col-md-4">
            <label for="display_resolution" class="form-label fw-semibold">Resolution</label>
            <input type="text" name="display_resolution" id="display_resolution" class="form-control" value="{{ request('display_resolution') }}">
        </div>
        <div class="col-md-4">
            <label for="memory_internal" class="form-label fw-semibold">Internal Storage (ROM)</label>
            <input type="text" name="memory_internal" id="memory_internal" class="form-control" value="{{ request('memory_internal') }}">
        </div>
        <div class="col-md-4">
            <label for="ram" class="form-label fw-semibold">RAM</label>
            <input type="text" name="ram" id="ram" class="form-control" value="{{ request('ram') }}">
        </div>

        <!-- Card Slot -->
        <div class="col-md-6">
            <label for="memory_card_slot" class="form-label fw-semibold">Card Slot</label>
            <select name="memory_card_slot" id="memory_card_slot" class="form-select">
                <option value="">Any</option>
                <option value="Yes" {{ request('memory_card_slot') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ request('memory_card_slot') == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <!-- Sensors -->
        <div class="col-md-6">
            <label for="features_sensors" class="form-label fw-semibold">Sensors</label>
            <input type="text" name="features_sensors" id="features_sensors" class="form-control" value="{{ request('features_sensors') }}">
        </div>

        <!-- Battery -->
        <div class="col-md-4">
            <label for="battery_type" class="form-label fw-semibold">Battery (mAh)</label>
            <input type="text" name="battery_type" id="battery_type" class="form-control" value="{{ request('battery_type') }}">
        </div>
        <div class="col-md-4">
            <label for="battery_charging" class="form-label fw-semibold">Wired Charging</label>
            <select name="battery_charging" id="battery_charging" class="form-select">
                <option value="">Any</option>
                <option value="Yes" {{ request('battery_charging') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ request('battery_charging') == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="battery_removable" class="form-label fw-semibold">Removable</label>
            <select name="battery_removable" id="battery_removable" class="form-select">
                <option value="">Any</option>
                <option value="Yes" {{ request('battery_removable') == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{ request('battery_removable') == 'No' ? 'selected' : '' }}>No</option>
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
        start: [{{ request('price_min', 50) }}, {{ request('price_max', 3000) }}],
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
