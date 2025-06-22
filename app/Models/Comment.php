<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'content',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }

    public function article()
    {
        return $this->belongsTo(\App\Models\Article::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(\App\Models\Comment::class, 'parent_id');
    }
}
