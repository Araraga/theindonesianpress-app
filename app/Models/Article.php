<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'subheadline', // <--- tambahkan subheadline juga
        'content',
        'featured_image',
        'excerpt',
        'status',
        'view_count',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'view_count' => 'integer',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
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

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    // Helper 
    public function getLikesCount()
    {
        return $this->likes()->count();
    }

    public function getCommentsCount()
    {
        return $this->comments()->where('is_approved', true)->count();
    }

    public function getBookmarksCount()
    {
        return $this->bookmarks()->count();
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isDraft()
    {
        return $this->status === 'draft';
    }

    public function isArchived()
    {
        return $this->status === 'archived';
    }
}
