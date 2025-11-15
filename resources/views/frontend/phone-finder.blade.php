@extends('frontend.layout.app')

@section('header')
    <link href="{{ asset('app-assets/css/bootstrap-slider.min.css') }}" rel="stylesheet">

    <style>
        .position-relative {
            width: 100%;
        }
        .position-relative span {
            background: #000;
            color: #fff;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
    </style>
@endsection

@section('content')
    <!-- Page Header -->
    <div class="text-white text-center" style="background: url('{{ asset('app-assets/images/finder.jpg') }}') center center / cover no-repeat; height: 200px;">
        <div class="d-flex justify-content-center align-items-center bg-dark bg-opacity-50 w-100 h-100">
            <h1 class="fw-bold my-0">Phone Finder</h1>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mt-4">
        <form action="{{ route('phone.finder.results') }}" method="POST" class="row">
            @csrf

            <!-- General -->
            <h3 class="mb-2">General</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="brand" class="fw-semibold me-3">Brand</label>
                <select name="brand" id="brand" class="form-select flex-grow-1">
                    <option value="">All Brands</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="year_range" class="fw-semibold me-3">Year</label>
                <div class="position-relative w-100">
                    <input id="year_range" type="text" name="year_range" class="form-range-slider w-100" data-slider-min="2000" data-slider-max="{{ date('Y') }}" data-slider-step="1" data-slider-value="[2000,{{ date('Y') }}]"/>
                    <span id="year_range_value" class="position-absolute top-0 end-0 fw-semibold"></span>
                </div>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="launch_status" class="fw-semibold me-3">Availability</label>
                <select name="launch_status" id="launch_status" class="form-select flex-grow-1">
                    <option value="">Any</option>
                    <option value="Available" {{ request('launch_status') == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Coming soon" {{ request('launch_status') == 'Coming soon' ? 'selected' : '' }}>Coming Soon</option>
                    <option value="Discontinued" {{ request('launch_status') == 'Discontinued' ? 'selected' : '' }}>Discontinued</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="price_range" class="fw-semibold me-3">Price</label>
                <div class="position-relative w-100">
                    <input id="price_range" type="text" name="price_range" class="form-range-slider w-100" data-slider-min="0" data-slider-max="{{ $maxPrice ?? 5000 }}" data-slider-step="50" data-slider-value="[0,{{ $maxPrice ?? 5000 }}]"/>
                    <span id="price_range_value" class="position-absolute top-0 end-0 fw-semibold"></span>
                </div>
            </div>

            <!-- Sim -->
            <h3 class="my-2">Sim</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3" for="dual_sim">Dual SIM</label>
                <input class="form-check-input" type="checkbox" name="dual_sim" id="dual_sim" value="1" {{ request('dual_sim') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3" for="e_sim">eSIM</label>
                <input class="form-check-input" type="checkbox" name="e_sim" id="e_sim" value="1" {{ request('e_sim') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label class="fw-semibold me-3 text-nowrap" for="body_sim_size">SIM Size</label>
                <select name="body_sim_size" id="body_sim_size" class="form-select flex-grow-1">
                    <option value="">Select SIM Size</option>
                    <option value="Mini-SIM" {{ request('body_sim_size') == 'Mini-SIM' ? 'selected' : '' }}>Mini-SIM</option>
                    <option value="Micro-SIM" {{ request('body_sim_size') == 'Micro-SIM' ? 'selected' : '' }}>Micro-SIM</option>
                    <option value="Nano-SIM" {{ request('body_sim_size') == 'Nano-SIM' ? 'selected' : '' }}>Nano-SIM</option>
                </select>
            </div>

            <!-- Network -->
            <h3 class="my-2">Network</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3" for="network_2g_bands">2G</label>
                <input class="form-check-input" type="checkbox" name="network_2g_bands" id="network_2g_bands" value="1" {{ request('network_2g_bands') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3" for="network_3g_bands">3G</label>
                <input class="form-check-input" type="checkbox" name="network_3g_bands" id="network_3g_bands" value="1" {{ request('network_3g_bands') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3" for="network_4g_bands">4G</label>
                <input class="form-check-input" type="checkbox" name="network_4g_bands" id="network_4g_bands" value="1" {{ request('network_4g_bands') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3" for="network_5g_bands">5G</label>
                <input class="form-check-input" type="checkbox" name="network_5g_bands" id="network_5g_bands" value="1" {{ request('network_5g_bands') ? 'checked' : '' }}>
            </div>

            <!-- Platform -->
            <h3 class="my-2">Platform</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label for="platform_os" class="fw-semibold me-3">OS</label>
                <select name="platform_os" id="platform_os" class="form-select w-100">
                    <option value="">Any</option>
                    <option value="android" {{ request('platform_os') == 'android' ? 'selected' : '' }}>Android</option>
                    <option value="ios" {{ request('platform_os') == 'ios' ? 'selected' : '' }}>iOS</option>
                    <option value="kaios" {{ request('platform_os') == 'kaios' ? 'selected' : '' }}>KaiOS</option>
                    <option value="windows phone" {{ request('platform_os') == 'windows phone' ? 'selected' : '' }}>Windows Phone</option>
                    <option value="symbian" {{ request('platform_os') == 'symbian' ? 'selected' : '' }}>Symbian</option>
                    <option value="rim" {{ request('platform_os') == 'rim' ? 'selected' : '' }}>BlackBerry (RIM)</option>
                    <option value="bada" {{ request('platform_os') == 'bada' ? 'selected' : '' }}>Bada</option>
                    <option value="firefox" {{ request('platform_os') == 'firefox' ? 'selected' : '' }}>Firefox OS</option>
                    <option value="other" {{ request('platform_os') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label for="platform_chipset" class="fw-semibold me-3">Chipset</label>
                <select name="platform_chipset" id="platform_chipset" class="form-select w-100">
                    <option value="">Any</option>
                    <option value="Snapdragon" {{ request('platform_chipset') == 'Snapdragon' ? 'selected' : '' }}>Snapdragon</option>
                    <option value="Apple A Series" {{ request('platform_chipset') == 'Apple A Series' ? 'selected' : '' }}>Apple A Series</option>
                    <option value="Apple M Series" {{ request('platform_chipset') == 'Apple M Series' ? 'selected' : '' }}>Apple M Series</option>
                    <option value="MediaTek Dimensity" {{ request('platform_chipset') == 'MediaTek Dimensity' ? 'selected' : '' }}>MediaTek Dimensity</option>
                    <option value="MediaTek Helio" {{ request('platform_chipset') == 'MediaTek Helio' ? 'selected' : '' }}>MediaTek Helio</option>
                    <option value="Exynos" {{ request('platform_chipset') == 'Exynos' ? 'selected' : '' }}>Exynos</option>
                    <option value="Kirin" {{ request('platform_chipset') == 'Kirin' ? 'selected' : '' }}>Kirin</option>
                    <option value="Google Tensor" {{ request('platform_chipset') == 'Google Tensor' ? 'selected' : '' }}>Google Tensor</option>
                    <option value="Intel Atom" {{ request('platform_chipset') == 'Intel Atom' ? 'selected' : '' }}>Intel Atom</option>
                    <option value="NVIDIA Tegra" {{ request('platform_chipset') == 'NVIDIA Tegra' ? 'selected' : '' }}>NVIDIA Tegra</option>
                    <option value="Other" {{ request('platform_chipset') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label for="platform_cpu_core" class="fw-semibold me-3 text-nowrap">CPU Core</label>
                <select name="platform_cpu_core" id="platform_cpu_core" class="form-select w-100">
                    <option value="">Any</option>
                    <option value="Single-core" {{ request('platform_cpu_core') == 'Single-core' ? 'selected' : '' }}>Single-core</option>
                    <option value="Dual-core" {{ request('platform_cpu_core') == 'Dual-core' ? 'selected' : '' }}>Dual-core</option>
                    <option value="Triple-core" {{ request('platform_cpu_core') == 'Triple-core' ? 'selected' : '' }}>Triple-core</option>
                    <option value="Quad-core" {{ request('platform_cpu_core') == 'Quad-core' ? 'selected' : '' }}>Quad-core</option>
                    <option value="Hexa-core" {{ request('platform_cpu_core') == 'Hexa-core' ? 'selected' : '' }}>Hexa-core</option>
                    <option value="Octa-core" {{ request('platform_cpu_core') == 'Octa-core' ? 'selected' : '' }}>Octa-core</option>
                    <option value="Deca-core" {{ request('platform_cpu_core') == 'Deca-core' ? 'selected' : '' }}>Deca-core</option>
                    <option value="Other" {{ request('platform_cpu_core') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Display -->
            <h3 class="my-2">Display</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="display_type" class="fw-semibold me-3">Type</label>
                <select name="display_type" id="display_type" class="form-select w-100">
                    <option value="">Any</option>
                    @foreach (['LCD','IPS LCD','TFT LCD','AMOLED','Super AMOLED','Dynamic AMOLED','LTPO AMOLED','OLED','POLED','Retina','Mini-LED','MicroLED','E-Ink','Other'] as $type)
                        <option value="{{ $type }}" {{ request('display_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="display_size" class="fw-semibold me-3">Size</label>
                <div class="position-relative w-100">
                    <input id="display_size" type="text" name="display_size" class="form-range-slider w-100" data-slider-min="3" data-slider-max="10" data-slider-step="0.01" data-slider-value="{{ request('display_size') ?? '[3,10]' }}"/>
                    <span id="display_size_value" class="position-absolute top-0 end-0 fw-semibold"></span>
                </div>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="display_resolution" class="fw-semibold me-3">Resolution</label>
                <select name="display_resolution" id="display_resolution" class="form-select w-100">
                    <option value="">Any</option>
                    @foreach (['HD','HD+','Full HD','Full HD+','Quad HD','Quad HD+','4K','5K','8K','Other'] as $res)
                        <option value="{{ $res }}" {{ request('display_resolution') == $res ? 'selected' : '' }}>{{ $res }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="display_refresh_rate" class="fw-semibold me-3 text-nowrap">Refresh Rate</label>
                <select name="display_refresh_rate" id="display_refresh_rate" class="form-select w-100">
                    <option value="">Any</option>
                    @foreach (['60Hz','75Hz','90Hz','120Hz','144Hz','165Hz','240Hz','Adaptive','Other'] as $rate)
                        <option value="{{ $rate }}" {{ request('display_refresh_rate') == $rate ? 'selected' : '' }}>{{ $rate }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Memory -->
            <h3 class="my-2">Memory</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="memory_internal_value" class="fw-semibold me-3 text-nowrap">Internal Memory</label>
                <input type="number" name="memory_internal_value" id="memory_internal_value" class="form-control w-50" 
                    value="{{ request('memory_internal_value') }}" min="0" step="1">
                <select name="memory_internal_unit" class="form-select ms-2 w-auto">
                    <option value="MB" {{ request('memory_internal_unit') == 'MB' ? 'selected' : '' }}>MB</option>
                    <option value="GB" {{ request('memory_internal_unit') == 'GB' ? 'selected' : '' }}>GB</option>
                    <option value="TB" {{ request('memory_internal_unit') == 'TB' ? 'selected' : '' }}>TB</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="memory_ram_value" class="fw-semibold me-3 text-nowrap">RAM</label>
                <input type="number" name="memory_ram_value" id="memory_ram_value" class="form-control w-100" 
                    value="{{ request('memory_ram_value') }}" min="0" step="1">
                <select name="memory_ram_unit" class="form-select ms-2 w-auto">
                    <option value="MB" {{ request('memory_ram_unit') == 'MB' ? 'selected' : '' }}>MB</option>
                    <option value="GB" {{ request('memory_ram_unit') == 'GB' ? 'selected' : '' }}>GB</option>
                    <option value="TB" {{ request('memory_ram_unit') == 'TB' ? 'selected' : '' }}>TB</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label for="memory_card_slot" class="fw-semibold me-3 text-nowrap">Memory Card Slot</label>
                <input type="checkbox" name="memory_card_slot" id="memory_card_slot" class="form-check-input" value="1" {{ request('memory_card_slot') ? 'checked' : '' }}>
            </div>

            <!-- Main Camera -->
            <h3 class="my-2">Main Camera</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="main_camera_pixel" class="fw-semibold me-3 text-nowrap">Main Camera</label>
                <input type="number" name="main_camera_pixel" id="main_camera_pixel" class="form-control w-50" value="{{ request('main_camera_pixel') }}" min="0" step="1">
                <select name="main_camera_unit" class="form-select ms-2 w-auto">
                    <option value="MP" selected>MP</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Ultra Wide</label>
                <input type="checkbox" name="main_camera_ultra_wide" id="main_camera_ultra_wide" value="1" {{ request('main_camera_ultra_wide') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Flash</label>
                <input type="checkbox" name="main_camera_flash" id="main_camera_flash" value="1" {{ request('main_camera_flash') ? 'checked' : '' }}>
            </div>

            <!-- Selfie Camera -->
            <h3 class="my-2">Selfie Camera</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="selfie_camera_pixel" class="fw-semibold me-3 text-nowrap">Selfie Camera</label>
                <input type="number" name="selfie_camera_pixel" id="selfie_camera_pixel" class="form-control w-50" value="{{ request('selfie_camera_pixel') }}" min="0" step="1">
                <select name="selfie_camera_unit" class="form-select ms-2 w-auto">
                    <option value="MP" selected>MP</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Flash</label>
                <input type="checkbox" name="selfie_camera_flash" id="selfie_camera_flash" value="1" {{ request('selfie_camera_flash') ? 'checked' : '' }}>
            </div>

            <!-- Sensors -->
            <h3 class="my-2">Sensors</h3>
            <div class="col-12">
                <div class="row">
                    @php
                        $sensors = ['accelerometer', 'gyroscope', 'proximity', 'ambient_light', 'magnetometer', 'barometer', 'fingerprint', 'face_id', 'heart_rate', 'compass', 'step_counter', 'temperature', 'humidity'];
                    @endphp

                    @foreach($sensors as $sensor)
                        <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                            <label class="fw-semibold me-3 text-nowrap" for="sensor_{{ $sensor }}">
                                {{ ucwords(str_replace('_', ' ', $sensor)) }}
                            </label>
                            <input type="checkbox" name="features_sensors[]" id="sensor_{{ $sensor }}" value="{{ $sensor }}"
                                {{ is_array(request('features_sensors')) && in_array($sensor, request('features_sensors')) ? 'checked' : '' }}>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Battery -->
            <h3 class="my-2">Battery</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="battery_capacity" class="fw-semibold me-3 text-nowrap">Battery Capacity (mAh)</label>
                <input type="number" name="battery_capacity" id="battery_capacity" class="form-control w-100" value="{{ request('battery_capacity') }}" min="0" step="50">
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Wireless Charging</label>
                <input type="checkbox" name="battery_wireless" id="battery_wireless" value="1" {{ request('battery_wireless') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Removable</label>
                <input type="checkbox" name="battery_removeable" id="battery_removeable" value="1" {{ request('battery_removeable') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Fast Charging</label>
                <input type="checkbox" name="battery_fast_speed" id="battery_fast_speed" value="1" {{ request('battery_fast_speed') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="battery_charging_speed" class="fw-semibold me-3 text-nowrap">Charging Speed (W)</label>
                <input type="number" name="battery_charging_speed" id="battery_charging_speed" class="form-control w-100" value="{{ request('battery_charging_speed') }}" min="0" step="50">
            </div>

            <!-- Audio -->
            <h3 class="my-2">Audio</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Loudspeaker</label>
                <input type="checkbox" name="sound_loudspeaker" id="sound_loudspeaker" value="1" {{ request('sound_loudspeaker') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Dual Speaker</label>
                <input type="checkbox" name="sound_dual_speaker" id="sound_dual_speaker" value="1" {{ request('sound_dual_speaker') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">3.5mm Jack</label>
                <input type="checkbox" name="sound_jack_3_5mm" id="sound_jack_3_5mm" value="1" {{ request('sound_jack_3_5mm') ? 'checked' : '' }}>
            </div>

            <!-- Connectivity -->
            <h3 class="my-2">Connectivity</h3>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="comms_wlan" class="fw-semibold me-3 text-nowrap">WLAN</label>
                <select name="comms_wlan" id="comms_wlan" class="form-select w-100">
                    <option value="">Any</option>
                    <option value="wifi_80211_a" {{ request('comms_wlan') == 'wifi_80211_a' ? 'selected' : '' }}>Wi-Fi 802.11a</option>
                    <option value="wifi_80211_b" {{ request('comms_wlan') == 'wifi_80211_b' ? 'selected' : '' }}>Wi-Fi 802.11b</option>
                    <option value="wifi_80211_g" {{ request('comms_wlan') == 'wifi_80211_g' ? 'selected' : '' }}>Wi-Fi 802.11g</option>
                    <option value="wifi_80211_n" {{ request('comms_wlan') == 'wifi_80211_n' ? 'selected' : '' }}>Wi-Fi 802.11n</option>
                    <option value="wifi_80211_ac" {{ request('comms_wlan') == 'wifi_80211_ac' ? 'selected' : '' }}>Wi-Fi 802.11ac</option>
                    <option value="wifi_80211_ax" {{ request('comms_wlan') == 'wifi_80211_ax' ? 'selected' : '' }}>Wi-Fi 802.11ax</option>
                    <option value="wifi_80211_be" {{ request('comms_wlan') == 'wifi_80211_be' ? 'selected' : '' }}>Wi-Fi 802.11be</option>
                    <option value="dual_band" {{ request('comms_wlan') == 'dual_band' ? 'selected' : '' }}>Dual Band</option>
                    <option value="wifi_direct" {{ request('comms_wlan') == 'wifi_direct' ? 'selected' : '' }}>Wi-Fi Direct</option>
                    <option value="hotspot" {{ request('comms_wlan') == 'hotspot' ? 'selected' : '' }}>Hotspot</option>
                    <option value="other" {{ request('comms_wlan') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="comms_bluetooth" class="fw-semibold me-3 text-nowrap">Bluetooth</label>
                <select name="comms_bluetooth" id="comms_bluetooth" class="form-select w-100">
                    <option value="">Any</option>
                    <option value="bluetooth_3" {{ request('comms_bluetooth') == 'bluetooth_3' ? 'selected' : '' }}>Bluetooth 3.0</option>
                    <option value="bluetooth_4" {{ request('comms_bluetooth') == 'bluetooth_4' ? 'selected' : '' }}>Bluetooth 4.0</option>
                    <option value="bluetooth_4_1" {{ request('comms_bluetooth') == 'bluetooth_4_1' ? 'selected' : '' }}>Bluetooth 4.1</option>
                    <option value="bluetooth_4_2" {{ request('comms_bluetooth') == 'bluetooth_4_2' ? 'selected' : '' }}>Bluetooth 4.2</option>
                    <option value="bluetooth_5" {{ request('comms_bluetooth') == 'bluetooth_5' ? 'selected' : '' }}>Bluetooth 5.0</option>
                    <option value="bluetooth_5_1" {{ request('comms_bluetooth') == 'bluetooth_5_1' ? 'selected' : '' }}>Bluetooth 5.1</option>
                    <option value="bluetooth_5_2" {{ request('comms_bluetooth') == 'bluetooth_5_2' ? 'selected' : '' }}>Bluetooth 5.2</option>
                    <option value="bluetooth_5_3" {{ request('comms_bluetooth') == 'bluetooth_5_3' ? 'selected' : '' }}>Bluetooth 5.3</option>
                    <option value="a2dp" {{ request('comms_bluetooth') == 'a2dp' ? 'selected' : '' }}>A2DP</option>
                    <option value="le" {{ request('comms_bluetooth') == 'le' ? 'selected' : '' }}>LE</option>
                    <option value="aptx" {{ request('comms_bluetooth') == 'aptx' ? 'selected' : '' }}>aptX</option>
                    <option value="other" {{ request('comms_bluetooth') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">GPS</label>
                <input type="checkbox" name="comms_gps" id="comms_gps" value="1" {{ request('comms_gps') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">NFC</label>
                <input type="checkbox" name="comms_nfc" id="comms_nfc" value="1" {{ request('comms_nfc') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center justify-content-between">
                <label class="fw-semibold me-3">Radio</label>
                <input type="checkbox" name="comms_radio" id="comms_radio" value="1" {{ request('comms_radio') ? 'checked' : '' }}>
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-center">
                <label for="comms_usb" class="fw-semibold me-3 text-nowrap">USB</label>
                <select name="comms_usb" id="comms_usb" class="form-select w-100">
                    <option value="">Any</option>
                    <option value="micro_usb" {{ request('comms_usb') == 'micro_usb' ? 'selected' : '' }}>Micro USB</option>
                    <option value="micro_usb_2_0" {{ request('comms_usb') == 'micro_usb_2_0' ? 'selected' : '' }}>Micro USB 2.0</option>
                    <option value="micro_usb_3_0" {{ request('comms_usb') == 'micro_usb_3_0' ? 'selected' : '' }}>Micro USB 3.0</option>
                    <option value="usb_c" {{ request('comms_usb') == 'usb_c' ? 'selected' : '' }}>USB-C</option>
                    <option value="usb_c_2_0" {{ request('comms_usb') == 'usb_c_2_0' ? 'selected' : '' }}>USB-C 2.0</option>
                    <option value="usb_c_3_1" {{ request('comms_usb') == 'usb_c_3_1' ? 'selected' : '' }}>USB-C 3.1</option>
                    <option value="usb_c_3_2" {{ request('comms_usb') == 'usb_c_3_2' ? 'selected' : '' }}>USB-C 3.2</option>
                    <option value="usb_c_displayport" {{ request('comms_usb') == 'usb_c_displayport' ? 'selected' : '' }}>USB-C DisplayPort</option>
                    <option value="usb_otg" {{ request('comms_usb') == 'usb_otg' ? 'selected' : '' }}>USB OTG</option>
                    <option value="proprietary" {{ request('comms_usb') == 'proprietary' ? 'selected' : '' }}>Proprietary</option>
                    <option value="other" {{ request('comms_usb') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary px-5">Find</button>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/bootstrap-slider.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Year Slider
            var yearSlider = $("#year_range").slider({
                tooltip: 'hide', // hide default tooltip
            });

            // Price Slider
            var priceSlider = $("#price_range").slider({
                tooltip: 'hide', // hide default tooltip
            });

            // Display Size Slider
            var sizeSlider = $("#display_size").slider({
                tooltip: 'hide', // hide default tooltip
            });

            // Update span values
            yearSlider.on('slide', function(event) {
                $('#year_range_value').text(event.value[0] + ' - ' + event.value[1]);
            });
            // Initialize
            $('#year_range_value').text(yearSlider.slider('getValue')[0] + ' - ' + yearSlider.slider('getValue')[1]);

            priceSlider.on('slide', function(event) {
                $('#price_range_value').text('$' + event.value[0] + ' - $' + event.value[1]);
            });
            // Initialize
            $('#price_range_value').text('$' + priceSlider.slider('getValue')[0] + ' - $' + priceSlider.slider('getValue')[1]);

            sizeSlider.on('slide', function(event) {
                if(Array.isArray(event.value)){
                    $('#display_size_value').text(event.value[0] + ' - ' + event.value[1] + ' inch');
                } else {
                    $('#display_size_value').text(event.value + ' inch');
                }
            });
            // Initialize
            let initSize = sizeSlider.slider('getValue');
            $('#display_size_value').text(Array.isArray(initSize) ? initSize[0] + ' - ' + initSize[1] + ' inch' : initSize + ' inch');
        });
    </script>
@endsection
