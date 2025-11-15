<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Mobile extends Model
{
    protected $fillable = [
        // Foreign Keys
        'user_id',
        'brand_id',

        // Basic Info
        'name',
        'slug',
        'status',
        'blog_color',
        'views',
        'image',
        'description',

        // Versions
        'versions',

        // Network
        'network_technology',
        'network_2g_bands',
        'network_3g_bands',
        'network_4g_bands',
        'network_5g_bands',
        'network_speed',

        // Launch
        'launch_date',
        'launch_status',

        // Body
        'body_dimensions',
        'body_weight',
        'body_build',
        'body_sim',
        'body_dual_sim',
        'body_e_sim',
        'body_sim_size',

        // Display
        'display_type_detail',
        'display_type',
        'display_size',
        'display_resolution_detail',
        'display_resolution',
        'display_refresh_rate',
        'display_protection',

        // Platform
        'platform_os',
        'platform_os_detail',
        'platform_chipset',
        'platform_chipset_detail',
        'platform_cpu',
        'platform_cpu_core',
        'platform_gpu',

        // Memory
        'memory_internal',
        'memory_internal_value',
        'memory_internal_unit',
        'memory_ram_value',
        'memory_ram_unit',
        'memory_card_slot',

        // Main Camera
        'main_camera_name',
        'main_camera_pixel',
        'main_camera_ultra_wide',
        'main_camera_flash',
        'main_camera_detail',
        'main_camera_features',
        'main_camera_video',

        // Selfie Camera
        'selfie_camera_name',
        'selfie_camera_pixel',
        'selfie_camera_flash',
        'selfie_camera_detail',
        'selfie_camera_features',
        'selfie_camera_video',

        // Sound
        'sound_loudspeaker',
        'sound_loudspeaker_detail',
        'sound_dual_speaker',
        'sound_jack_3_5mm',

        // Communications
        'comms_wlan',
        'comms_bluetooth',
        'comms_gps',
        'comms_nfc',
        'comms_radio',
        'comms_usb',

        // Features
        'features_sensors',
        'features_sensors_details',
        'features_extra',

        // Battery
        'battery_detail',
        'battery_capacity',
        'battery_wireless',
        'battery_removeable',
        'battery_fast_speed',
        'battery_charging_speed',

        // Misc
        'misc_colors',
        'misc_models',
        'misc_sar_us_head',
        'misc_sar_us_body',
        'misc_sar_eu_head',
        'misc_sar_eu_body',
        'misc_price',

        // SEO
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($mobile) {
            $mobile->slug = Str::slug($mobile->name);
        });

        static::updating(function ($mobile) {
            $mobile->slug = Str::slug($mobile->name);
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function comments()
    {
        return $this->hasMany(MobileComment::class);
    }

    public function news()
    {
        return $this->hasOne(News::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function video()
    {
        return $this->hasOne(Video::class);
    }
}
