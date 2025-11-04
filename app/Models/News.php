<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
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

        // SEO
        'seo_title',
        'seo_keywords',
        'seo_description',
    ];

    // Slug management
    protected static function booted()
    {
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });

        static::updating(function ($mobile) {
            $news->slug = Str::slug($news->title);
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
        return $this->hasMany(NewsComment::class);
    }
}
