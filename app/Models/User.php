<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
        'bio',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(\App\Models\Bookmark::class);
    }

    public function followers()
    {
        return $this->hasMany(\App\Models\Follower::class, 'following_id');
    }

    public function following()
    {
        return $this->hasMany(\App\Models\Follower::class, 'follower_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(\App\Models\ActivityLog::class);
    }

    // Helper 
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function getPublishedArticlesCount()
    {
        return $this->articles()->where('status', 'published')->count();
    }

    public function getTotalViewCount()
    {
        return $this->articles()->sum('view_count');
    }

    public function getFollowersCount()
    {
        return $this->followers()->count();
    }

    public function getFollowingCount()
    {
        return $this->following()->count();
    }
}
