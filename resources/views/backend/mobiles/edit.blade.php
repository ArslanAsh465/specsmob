@extends('backend.layout.app')

@if(!empty($title))
    @section('title', $title)
@endif

@section('content')
    <!-- Page Header -->
    <div class="mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.mobiles.index') }}" class="text-decoration-none">Mobiles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Mobile</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Edit Mobile</h1>
        </div>
    </div>

    <!-- Edit Mobile Form -->
    <div class="shadow-sm rounded bg-white p-3 mt-4">
        <form action="{{ route('backend.mobiles.update', $mobile->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <!-- Brand -->
                <div class="col-12">
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id', $mobile->brand_id ?? '') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Name -->
                <div class="col-12">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $mobile->name ?? '') }}" placeholder="Enter name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Versions -->
                <div class="col-12">
                    <label for="versions" class="form-label">Versions</label>
                    <textarea name="versions" id="versions" rows="2" class="form-control @error('versions') is-invalid @enderror">{{ old('versions', $mobile->versions ?? '') }}</textarea>
                    @error('versions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Network -->
                <div class="col-12">
                    <label for="network_technology" class="form-label">Technology</label>
                    <textarea name="network_technology" id="network_technology" rows="2" class="form-control @error('network_technology') is-invalid @enderror">{{ old('network_technology', $mobile->network_technology ?? '') }}</textarea>
                    @error('network_technology')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="network_2g_bands" class="form-label">2G Bands</label>
                    <textarea name="network_2g_bands" id="network_2g_bands" rows="2" class="form-control @error('network_2g_bands') is-invalid @enderror">{{ old('network_2g_bands', $mobile->network_2g_bands ?? '') }}</textarea>
                    @error('network_2g_bands')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="network_3g_bands" class="form-label">3G Bands</label>
                    <textarea name="network_3g_bands" id="network_3g_bands" rows="2" class="form-control @error('network_3g_bands') is-invalid @enderror">{{ old('network_3g_bands', $mobile->network_3g_bands ?? '') }}</textarea>
                    @error('network_3g_bands')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="network_4g_bands" class="form-label">4G Bands</label>
                    <textarea name="network_4g_bands" id="network_4g_bands" rows="2" class="form-control @error('network_4g_bands') is-invalid @enderror">{{ old('network_4g_bands', $mobile->network_4g_bands ?? '') }}</textarea>
                    @error('network_4g_bands')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="network_5g_bands" class="form-label">5G Bands</label>
                    <textarea name="network_5g_bands" id="network_5g_bands" rows="2" class="form-control @error('network_5g_bands') is-invalid @enderror">{{ old('network_5g_bands', $mobile->network_5g_bands ?? '') }}</textarea>
                    @error('network_5g_bands')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="network_speed" class="form-label">Speed</label>
                    <textarea name="network_speed" id="network_speed" rows="2" class="form-control @error('network_speed') is-invalid @enderror">{{ old('network_speed', $mobile->network_speed ?? '') }}</textarea>
                    @error('network_speed')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Launch -->
                <div class="col-12">
                    <label for="launch_date" class="form-label">Launch Date</label>
                    <textarea name="launch_date" id="launch_date" rows="2" class="form-control @error('launch_date') is-invalid @enderror">{{ old('launch_date', $mobile->launch_date ?? '') }}</textarea>
                    @error('launch_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="launch_status" class="form-label">Launch Status</label>
                    <textarea name="launch_status" id="launch_status" rows="2" class="form-control @error('launch_status') is-invalid @enderror">{{ old('launch_status', $mobile->launch_status ?? '') }}</textarea>
                    @error('launch_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Body -->
                <div class="col-12">
                    <label for="body_dimensions" class="form-label">Dimensions</label>
                    <textarea name="body_dimensions" id="body_dimensions" rows="2" class="form-control @error('body_dimensions') is-invalid @enderror">{{ old('body_dimensions', $mobile->body_dimensions ?? '') }}</textarea>
                    @error('body_dimensions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="body_weight" class="form-label">Weight</label>
                    <textarea name="body_weight" id="body_weight" rows="2" class="form-control @error('body_weight') is-invalid @enderror">{{ old('body_weight', $mobile->body_weight ?? '') }}</textarea>
                    @error('body_weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="body_build" class="form-label">Build</label>
                    <textarea name="body_build" id="body_build" rows="2" class="form-control @error('body_build') is-invalid @enderror">{{ old('body_build', $mobile->body_build ?? '') }}</textarea>
                    @error('body_build')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="body_sim" class="form-label">SIM</label>
                    <textarea name="body_sim" id="body_sim" rows="2" class="form-control @error('body_sim') is-invalid @enderror">{{ old('body_sim', $mobile->body_sim ?? '') }}</textarea>
                    @error('body_sim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Display -->
                <div class="col-12">
                    <label for="display_type" class="form-label">Type</label>
                    <textarea name="display_type" id="display_type" rows="2" class="form-control @error('display_type') is-invalid @enderror">{{ old('display_type', $mobile->display_type ?? '') }}</textarea>
                    @error('display_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="display_size" class="form-label">Size</label>
                    <textarea name="display_size" id="display_size" rows="2" class="form-control @error('display_size') is-invalid @enderror">{{ old('display_size', $mobile->display_size ?? '') }}</textarea>
                    @error('display_size') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="col-12">
                    <label for="display_resolution" class="form-label">Resolution</label>
                    <textarea name="display_resolution" id="display_resolution" rows="2" class="form-control @error('display_resolution') is-invalid @enderror">{{ old('display_resolution', $mobile->display_resolution ?? '') }}</textarea>
                    @error('display_resolution') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="col-12">
                    <label for="display_protection" class="form-label">Protection</label>
                    <textarea name="display_protection" id="display_protection" rows="2" class="form-control @error('display_protection') is-invalid @enderror">{{ old('display_protection', $mobile->display_protection ?? '') }}</textarea>
                    @error('display_protection') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <!-- Platform -->
                <div class="col-12">
                    <label for="platform_os" class="form-label">OS</label>
                    <textarea name="platform_os" id="platform_os" rows="2" class="form-control @error('platform_os') is-invalid @enderror">{{ old('platform_os', $mobile->platform_os ?? '') }}</textarea>
                    @error('platform_os') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="col-12">
                    <label for="platform_chipset" class="form-label">Chipset</label>
                    <textarea name="platform_chipset" id="platform_chipset" rows="2" class="form-control @error('platform_chipset') is-invalid @enderror">{{ old('platform_chipset', $mobile->platform_chipset ?? '') }}</textarea>
                    @error('platform_chipset') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="col-12">
                    <label for="platform_cpu" class="form-label">CPU</label>
                    <textarea name="platform_cpu" id="platform_cpu" rows="2" class="form-control @error('platform_cpu') is-invalid @enderror">{{ old('platform_cpu', $mobile->platform_cpu ?? '') }}</textarea>
                    @error('platform_cpu') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>
                <div class="col-12">
                    <label for="platform_gpu" class="form-label">GPU</label>
                    <textarea name="platform_gpu" id="platform_gpu" rows="2" class="form-control @error('platform_gpu') is-invalid @enderror">{{ old('platform_gpu', $mobile->platform_gpu ?? '') }}</textarea>
                    @error('platform_gpu') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <!-- Memory -->
                <div class="col-12">
                    <label for="memory_card_slot" class="form-label">Card Slot</label>
                    <textarea name="memory_card_slot" id="memory_card_slot" rows="2" class="form-control @error('memory_card_slot') is-invalid @enderror">{{ old('memory_card_slot', $mobile->memory_card_slot ?? '') }}</textarea>
                    @error('memory_card_slot')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="memory_internal" class="form-label">Internal</label>
                    <textarea name="memory_internal" id="memory_internal" rows="2" class="form-control @error('memory_internal') is-invalid @enderror">{{ old('memory_internal', $mobile->memory_internal ?? '') }}</textarea>
                    @error('memory_internal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Main Camera -->
                <div class="col-12">
                    <label for="main_camera_setup" class="form-label">Setup</label>
                    <textarea name="main_camera_setup" id="main_camera_setup" rows="2" class="form-control @error('main_camera_setup') is-invalid @enderror">{{ old('main_camera_setup', $mobile->main_camera_setup ?? '') }}</textarea>
                    @error('main_camera_setup')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="main_camera_features" class="form-label">Features</label>
                    <textarea name="main_camera_features" id="main_camera_features" rows="2" class="form-control @error('main_camera_features') is-invalid @enderror">{{ old('main_camera_features', $mobile->main_camera_features ?? '') }}</textarea>
                    @error('main_camera_features')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="main_camera_video" class="form-label">Video</label>
                    <textarea name="main_camera_video" id="main_camera_video" rows="2" class="form-control @error('main_camera_video') is-invalid @enderror">{{ old('main_camera_video', $mobile->main_camera_video ?? '') }}</textarea>
                    @error('main_camera_video')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Selfie Camera -->
                <div class="col-12">
                    <label for="selfie_camera_setup" class="form-label">Setup</label>
                    <textarea name="selfie_camera_setup" id="selfie_camera_setup" rows="2" class="form-control @error('selfie_camera_setup') is-invalid @enderror">{{ old('selfie_camera_setup', $mobile->selfie_camera_setup ?? '') }}</textarea>
                    @error('selfie_camera_setup')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="selfie_camera_features" class="form-label">Features</label>
                    <textarea name="selfie_camera_features" id="selfie_camera_features" rows="2" class="form-control @error('selfie_camera_features') is-invalid @enderror">{{ old('selfie_camera_features', $mobile->selfie_camera_features ?? '') }}</textarea>
                    @error('selfie_camera_features')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="selfie_camera_video" class="form-label">Video</label>
                    <textarea name="selfie_camera_video" id="selfie_camera_video" rows="2" class="form-control @error('selfie_camera_video') is-invalid @enderror">{{ old('selfie_camera_video', $mobile->selfie_camera_video ?? '') }}</textarea>
                    @error('selfie_camera_video')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sound -->
                <div class="col-12">
                    <label for="sound_loudspeaker" class="form-label">Loudspeaker</label>
                    <textarea name="sound_loudspeaker" id="sound_loudspeaker" rows="2" class="form-control @error('sound_loudspeaker') is-invalid @enderror">{{ old('sound_loudspeaker', $mobile->sound_loudspeaker ?? '') }}</textarea>
                    @error('sound_loudspeaker')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="sound_jack_3_5mm" class="form-label">3.5mm Jack</label>
                    <textarea name="sound_jack_3_5mm" id="sound_jack_3_5mm" rows="2" class="form-control @error('sound_jack_3_5mm') is-invalid @enderror">{{ old('sound_jack_3_5mm', $mobile->sound_jack_3_5mm ?? '') }}</textarea>
                    @error('sound_jack_3_5mm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Communications -->
                <div class="col-12">
                    <label for="comms_wlan" class="form-label">WLAN</label>
                    <textarea name="comms_wlan" id="comms_wlan" rows="2" class="form-control @error('comms_wlan') is-invalid @enderror">{{ old('comms_wlan', $mobile->comms_wlan ?? '') }}</textarea>
                    @error('comms_wlan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="comms_bluetooth" class="form-label">Bluetooth</label>
                    <textarea name="comms_bluetooth" id="comms_bluetooth" rows="2" class="form-control @error('comms_bluetooth') is-invalid @enderror">{{ old('comms_bluetooth', $mobile->comms_bluetooth ?? '') }}</textarea>
                    @error('comms_bluetooth')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="comms_positioning" class="form-label">Positioning</label>
                    <textarea name="comms_positioning" id="comms_positioning" rows="2" class="form-control @error('comms_positioning') is-invalid @enderror">{{ old('comms_positioning', $mobile->comms_positioning ?? '') }}</textarea>
                    @error('comms_positioning')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="comms_nfc" class="form-label">NFC</label>
                    <textarea name="comms_nfc" id="comms_nfc" rows="2" class="form-control @error('comms_nfc') is-invalid @enderror">{{ old('comms_nfc', $mobile->comms_nfc ?? '') }}</textarea>
                    @error('comms_nfc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="comms_radio" class="form-label">Radio</label>
                    <textarea name="comms_radio" id="comms_radio" rows="2" class="form-control @error('comms_radio') is-invalid @enderror">{{ old('comms_radio', $mobile->comms_radio ?? '') }}</textarea>
                    @error('comms_radio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="comms_usb" class="form-label">USB</label>
                    <textarea name="comms_usb" id="comms_usb" rows="2" class="form-control @error('comms_usb') is-invalid @enderror">{{ old('comms_usb', $mobile->comms_usb ?? '') }}</textarea>
                    @error('comms_usb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Features -->
                <div class="col-12">
                    <label for="features_sensors" class="form-label">Sensors</label>
                    <textarea name="features_sensors" id="features_sensors" rows="2" class="form-control @error('features_sensors') is-invalid @enderror">{{ old('features_sensors', $mobile->features_sensors ?? '') }}</textarea>
                    @error('features_sensors')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="features_extra" class="form-label">Extra Features</label>
                    <textarea name="features_extra" id="features_extra" rows="2" class="form-control @error('features_extra') is-invalid @enderror">{{ old('features_extra', $mobile->features_extra ?? '') }}</textarea>
                    @error('features_extra')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Battery -->
                <div class="col-12">
                    <label for="battery_type" class="form-label">Battery Type</label>
                    <textarea name="battery_type" id="battery_type" rows="2" class="form-control @error('battery_type') is-invalid @enderror">{{ old('battery_type', $mobile->battery_type ?? '') }}</textarea>
                    @error('battery_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="battery_charging" class="form-label">Charging</label>
                    <textarea name="battery_charging" id="battery_charging" rows="2" class="form-control @error('battery_charging') is-invalid @enderror">{{ old('battery_charging', $mobile->battery_charging ?? '') }}</textarea>
                    @error('battery_charging')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Misc -->
                <div class="col-12">
                    <label for="misc_colors" class="form-label">Colors</label>
                    <textarea name="misc_colors" id="misc_colors" rows="2" class="form-control @error('misc_colors') is-invalid @enderror">{{ old('misc_colors', $mobile->misc_colors ?? '') }}</textarea>
                    @error('misc_colors')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="misc_models" class="form-label">Models</label>
                    <textarea name="misc_models" id="misc_models" rows="2" class="form-control @error('misc_models') is-invalid @enderror">{{ old('misc_models', $mobile->misc_models ?? '') }}</textarea>
                    @error('misc_models')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="misc_sar_us_head" class="form-label">SAR US (Head)</label>
                    <textarea name="misc_sar_us_head" id="misc_sar_us_head" rows="2" class="form-control @error('misc_sar_us_head') is-invalid @enderror">{{ old('misc_sar_us_head', $mobile->misc_sar_us_head ?? '') }}</textarea>
                    @error('misc_sar_us_head')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="misc_sar_us_body" class="form-label">SAR US (Body)</label>
                    <textarea name="misc_sar_us_body" id="misc_sar_us_body" rows="2" class="form-control @error('misc_sar_us_body') is-invalid @enderror">{{ old('misc_sar_us_body', $mobile->misc_sar_us_body ?? '') }}</textarea>
                    @error('misc_sar_us_body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="misc_sar_eu_head" class="form-label">SAR EU (Head)</label>
                    <textarea name="misc_sar_eu_head" id="misc_sar_eu_head" rows="2" class="form-control @error('misc_sar_eu_head') is-invalid @enderror">{{ old('misc_sar_eu_head', $mobile->misc_sar_eu_head ?? '') }}</textarea>
                    @error('misc_sar_eu_head')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="misc_sar_eu_body" class="form-label">SAR EU (Body)</label>
                    <textarea name="misc_sar_eu_body" id="misc_sar_eu_body" rows="2" class="form-control @error('misc_sar_eu_body') is-invalid @enderror">{{ old('misc_sar_eu_body', $mobile->misc_sar_eu_body ?? '') }}</textarea>
                    @error('misc_sar_eu_body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="misc_price" class="form-label">Price</label>
                    <textarea name="misc_price" id="misc_price" rows="2" class="form-control @error('misc_price') is-invalid @enderror">{{ old('misc_price', $mobile->misc_price ?? '') }}</textarea>
                    @error('misc_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SEO -->
                <div class="col-12">
                    <label for="seo_title" class="form-label">SEO Title</label>
                    <input type="text" name="seo_title" id="seo_title" class="form-control @error('seo_title') is-invalid @enderror" value="{{ old('seo_title', $mobile->seo_title ?? '') }}" placeholder="Enter SEO Title">
                    @error('seo_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="seo_keywords" class="form-label">SEO Keywords</label>
                    <input type="text" name="seo_keywords" id="seo_keywords" class="form-control @error('seo_keywords') is-invalid @enderror" value="{{ old('seo_keywords', $mobile->seo_keywords ?? '') }}" placeholder="Enter SEO Keywords">
                    @error('seo_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="seo_description" class="form-label">SEO Description</label>
                    <textarea name="seo_description" id="seo_description" rows="2" class="form-control @error('seo_description') is-invalid @enderror">{{ old('seo_description', $mobile->seo_description ?? '') }}</textarea>
                    @error('seo_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- General -->
                <div class="col-12">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="0" {{ old('status', $mobile->status ?? 0) == 0 ? 'selected' : '' }}>Inactive</option>
                        <option value="1" {{ old('status', $mobile->status ?? 0) == 1 ? 'selected' : '' }}>Active</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="color" class="form-label">Color</label>
                    <input type="color" id="color" name="color" class="form-control form-control-color" value="{{ old('color', $mobile->color ?? '#ff0000') }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if(!empty($mobile->image))
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $mobile->image) }}" alt="Current Image" style="max-width:150px;">
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $mobile->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12 mt-3">
                    <button class="btn btn-primary">Update Mobile</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('app-assets/js/ckeditor.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    ckfinder: {
                        uploadUrl: "{{ route('ckeditor.upload').'?_token='.csrf_token() }}"
                    }
                })
                .then(editor => {
                    const editableElement = editor.ui.view.editable.element;
                    editableElement.style.minHeight = '150px';

                    const form = editor.sourceElement.form;
                    if (form) {
                        form.addEventListener('submit', e => {
                            document.querySelector('#description').value = editor.getData();
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection