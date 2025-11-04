<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'mobile_id',
        'title',
        'slug',
        'image',
        'status',
        'body',
        'views',
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    // Slug management
    protected static function booted()
    {
        static::creating(function ($review) {
            $review->slug = Str::slug($review->title);
        });

        static::updating(function ($mobile) {
            $review->slug = Str::slug($review->title);
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobile()
    {
        return $this->belongsTo(Mobile::class);
    }

    public function comments()
    {
        return $this->hasMany(ReviewComment::class);
    }
}
