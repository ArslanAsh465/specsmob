<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Mobile extends Model
{
    protected $fillable = [
        'user_id',
        'brand_id',

        'name',
        'slug',

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

        // Display
        'display_type',
        'display_size',
        'display_resolution',
        'display_protection',

        // Platform
        'platform_os',
        'platform_chipset',
        'platform_cpu',
        'platform_gpu',

        // Memory
        'memory_card_slot',
        'memory_internal',

        // Main Camera
        'main_camera_setup',
        'main_camera_features',
        'main_camera_video',

        // Selfie Camera
        'selfie_camera_setup',
        'selfie_camera_features',
        'selfie_camera_video',

        // Sound
        'sound_loudspeaker',
        'sound_jack_3_5mm',

        // Communications
        'comms_wlan',
        'comms_bluetooth',
        'comms_positioning',
        'comms_nfc',
        'comms_radio',
        'comms_usb',

        // Features
        'features_sensors',
        'features_extra',

        // Battery
        'battery_type',
        'battery_charging',

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

        // General
        'status',
        'views',
        'image',
        'description',
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
