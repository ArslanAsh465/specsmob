<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
