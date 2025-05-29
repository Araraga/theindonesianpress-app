<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Bookmark;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'genre',
        'title',
        'subheadline',
        'content',
        'featured_image',
        'excerpt',
        'status',
        'published_at',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
