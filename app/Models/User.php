<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_ADMIN   = '1';
    const ROLE_MANAGER = '2';
    const ROLE_USER    = '3';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'status'            => 'boolean',
        ];
    }

    // Relationships
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    public function mobiles()
    {
        return $this->hasMany(Mobile::class);
    }

    public function mobileComments()
    {
        return $this->hasMany(MobileComment::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function newsComments()
    {
        return $this->hasMany(NewsComment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reviewComments()
    {
        return $this->hasMany(ReviewComment::class);
    }
}
