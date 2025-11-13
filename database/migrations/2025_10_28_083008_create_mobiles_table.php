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

            // Versions
            $table->text('versions')->nullable();
            
            // Network
            $table->text('network_technology')->nullable();
            $table->text('network_2g_bands')->nullable();
            $table->text('network_3g_bands')->nullable();
            $table->text('network_4g_bands')->nullable();
            $table->text('network_5g_bands')->nullable();
            $table->text('network_speed')->nullable();

            // Launch
            $table->date('launch_date')->nullable();
            $table->text('launch_status')->nullable();

            // Body
            $table->text('body_dimensions')->nullable();
            $table->text('body_weight')->nullable();
            $table->text('body_build')->nullable();
            $table->text('body_sim')->nullable();

            // Display
            $table->text('display_type')->nullable();
            $table->text('display_size')->nullable();
            $table->text('display_resolution')->nullable();
            $table->text('display_protection')->nullable();

            // Platform
            $table->text('platform_os')->nullable();
            $table->text('platform_chipset')->nullable();
            $table->text('platform_cpu')->nullable();
            $table->text('platform_gpu')->nullable();

            // Memory
            $table->text('memory_card_slot')->nullable();
            $table->text('memory_internal')->nullable();

            // Main Camera
            $table->text('main_camera_setup')->nullable();
            $table->text('main_camera_features')->nullable();
            $table->text('main_camera_video')->nullable();

            // Selfie Camera
            $table->text('selfie_camera_setup')->nullable();
            $table->text('selfie_camera_features')->nullable();
            $table->text('selfie_camera_video')->nullable();

            // Sound
            $table->text('sound_loudspeaker')->nullable();
            $table->text('sound_jack_3_5mm')->nullable();

            // Communications
            $table->text('comms_wlan')->nullable();
            $table->text('comms_bluetooth')->nullable();
            $table->text('comms_positioning')->nullable();
            $table->text('comms_nfc')->nullable();
            $table->text('comms_radio')->nullable();
            $table->text('comms_usb')->nullable();

            // Features
            $table->text('features_sensors')->nullable();
            $table->text('features_extra')->nullable();

            // Battery
            $table->text('battery_type')->nullable();
            $table->text('battery_charging')->nullable();

            // Misc
            $table->text('misc_colors')->nullable();
            $table->text('misc_models')->nullable();
            $table->text('misc_sar_us_head')->nullable();
            $table->text('misc_sar_us_body')->nullable();
            $table->text('misc_sar_eu_head')->nullable();
            $table->text('misc_sar_eu_body')->nullable();
            $table->decimal('misc_price', 10, 2);

            // SEO
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();

            // General
            $table->boolean('status')->default(false);
            $table->string('color')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->string('image')->nullable();
            $table->text('description')->nullable();

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
