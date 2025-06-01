<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'following_id');
    }

    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
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