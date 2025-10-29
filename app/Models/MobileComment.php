<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileComment extends Model
{
    protected $fillable = [
        'mobile_id',
        'user_id',
        'comment',
        'stars',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobile()
    {
        return $this->belongsTo(Mobile::class);
    }
}
