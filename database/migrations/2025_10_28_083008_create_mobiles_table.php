<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mobiles', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('brand_id');

            // Basic Info
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->boolean('status')->default(false);
            $table->string('blog_color')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->string('image')->nullable();
            $table->text('description')->nullable();

            // Versions
            $table->string('versions')->nullable();
            
            // Network
            $table->string('network_technology')->nullable();
            $table->string('network_2g_bands')->nullable();
            $table->string('network_3g_bands')->nullable();
            $table->string('network_4g_bands')->nullable();
            $table->string('network_5g_bands')->nullable();
            $table->string('network_speed')->nullable();

            // Launch
            $table->date('launch_date')->nullable();
            $table->enum('launch_status', ['Available', 'Coming soon', 'Discontinued'])->nullable();

            // Body
            $table->string('body_dimensions')->nullable();
            $table->decimal('body_weight', 10, 2);
            $table->string('body_build')->nullable();
            $table->string('body_sim')->nullable();
            $table->boolean('body_dual_sim')->default(false);
            $table->boolean('body_e_sim')->default(false);
            $table->set('body_sim_size', ['Mini-SIM', 'Micro-SIM', 'Nano-SIM'])->nullable();

            // Display
            $table->string('display_type_detail')->nullable();
            $table->enum('display_type', ['LCD', 'IPS LCD', 'TFT LCD', 'AMOLED', 'Super AMOLED', 'Dynamic AMOLED', 'LTPO AMOLED', 'OLED', 'POLED', 'Retina', 'Mini-LED', 'MicroLED', 'E-Ink', 'Other'])->nullable();
            $table->decimal('display_size', 10, 2);
            $table->string('display_resolution_detail')->nullable();
            $table->enum('display_resolution', ['HD', 'HD+', 'Full HD', 'Full HD+', 'Quad HD', 'Quad HD+', '4K', '5K', '8K', 'Other'])->nullable();
            $table->enum('display_refresh_rate', ['60Hz', '75Hz', '90Hz', '120Hz', '144Hz', '165Hz', '240Hz', 'Adaptive', 'Other'])->nullable();
            $table->string('display_protection')->nullable();

            // Platform
            $table->enum('platform_os', ['android', 'ios', 'kaios', 'windows phone', 'symbian', 'rim', 'bada', 'firefox', 'other'])->nullable();
            $table->string('platform_os_detail')->nullable();
            $table->enum('platform_chipset', ['Snapdragon', 'Apple A Series', 'Apple M Series', 'MediaTek Dimensity', 'MediaTek Helio', 'Exynos', 'Kirin', 'Google Tensor', 'Intel Atom', 'NVIDIA Tegra', 'Other'])->nullable();
            $table->string('platform_chipset_detail')->nullable();
            $table->string('platform_cpu')->nullable();
            $table->enum('platform_cpu_core', ['Single-core', 'Dual-core', 'Triple-core', 'Quad-core', 'Hexa-core', 'Octa-core', 'Deca-core', 'Other'])->nullable();
            $table->string('platform_gpu')->nullable();

            // Memory
            $table->string('memory_internal')->nullable();
            $table->integer('memory_internal_value')->nullable();
            $table->enum('memory_internal_unit', ['MB', 'GB', 'TB'])->nullable();
            $table->integer('memory_ram_value')->nullable();
            $table->enum('memory_ram_unit', ['MB', 'GB', 'TB'])->nullable();
            $table->boolean('memory_card_slot')->default(false);

            // Main Camera
            $table->string('main_camera_name')->nullable();
            $table->integer('main_camera_pixel')->nullable();
            $table->boolean('main_camera_ultra_wide')->default(false);
            $table->boolean('main_camera_flash')->default(false);
            $table->string('main_camera_detail')->nullable();
            $table->string('main_camera_features')->nullable();
            $table->string('main_camera_video')->nullable();

            // Selfie Camera
            $table->string('selfie_camera_name')->nullable();
            $table->integer('selfie_camera_pixel')->nullable();
            $table->boolean('selfie_camera_flash')->default(false);
            $table->string('selfie_camera_detail')->nullable();
            $table->string('selfie_camera_features')->nullable();
            $table->string('selfie_camera_video')->nullable();

            // Sound
            $table->boolean('sound_loudspeaker')->default(false);
            $table->string('sound_loudspeaker_detail')->nullable();
            $table->boolean('sound_dual_speaker')->default(false);
            $table->boolean('sound_jack_3_5mm')->default(false);

            // Communications
            $table->enum('comms_wlan', ['wifi_80211_a', 'wifi_80211_b', 'wifi_80211_g', 'wifi_80211_n', 'wifi_80211_ac', 'wifi_80211_ax', 'wifi_80211_be', 'dual_band', 'wifi_direct', 'hotspot', 'other'])->nullable();
            $table->enum('comms_bluetooth', ['bluetooth_3', 'bluetooth_4', 'bluetooth_4_1', 'bluetooth_4_2', 'bluetooth_5', 'bluetooth_5_1', 'bluetooth_5_2', 'bluetooth_5_3', 'a2dp', 'le', 'aptx', 'other'])->nullable();
            $table->boolean('comms_gps')->default(false);
            $table->boolean('comms_nfc')->default(false);
            $table->boolean('comms_radio')->default(false);
            $table->enum('comms_usb', ['micro_usb', 'micro_usb_2_0', 'micro_usb_3_0', 'usb_c', 'usb_c_2_0', 'usb_c_3_1', 'usb_c_3_2', 'usb_c_displayport', 'usb_otg', 'proprietary', 'other'])->nullable();

            // Features
            $table->set('features_sensors', ['accelerometer', 'gyroscope', 'proximity', 'ambient_light', 'magnetometer', 'barometer', 'fingerprint', 'face_id', 'heart_rate', 'compass', 'step_counter', 'temperature', 'humidity', 'other'])->nullable();
            $table->string('features_sensors_details')->nullable();
            $table->string('features_extra')->nullable();

            // Battery
            $table->string('battery_detail')->nullable();
            $table->integer('battery_capacity')->nullable();
            $table->boolean('battery_wireless')->default(false);
            $table->boolean('battery_removeable')->default(false);
            $table->boolean('battery_fast_speed')->default(false);
            $table->integer('battery_charging_speed')->nullable();

            // Misc
            $table->set('misc_colors', ['black', 'white', 'silver', 'gray', 'gold', 'rose_gold', 'blue', 'navy', 'green', 'red', 'purple', 'orange', 'yellow', 'pink', 'bronze', 'titanium', 'graphite', 'other'])->nullable();
            $table->string('misc_models')->nullable();
            $table->string('misc_sar_us_head')->nullable();
            $table->string('misc_sar_us_body')->nullable();
            $table->string('misc_sar_eu_head')->nullable();
            $table->string('misc_sar_eu_body')->nullable();
            $table->decimal('misc_price', 10, 2);

            // SEO
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobiles');
    }
};
