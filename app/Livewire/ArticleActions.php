<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticleActions extends Component
{
    public $articleId;
    public $liked = false;
    public $likeCount = 0;
    public $bookmarked = false;

    public function mount($articleId)
    {
        $this->articleId = $articleId;
        $article = Article::withCount('likes')->findOrFail($articleId);
        $this->likeCount = $article->likes_count;
        if (auth()->check()) {
            $this->liked = $article->likes()->where('user_id', auth()->id())->exists();
            $this->bookmarked = $article->bookmarks()->where('user_id', auth()->id())->exists();
        }
    }

    public function like()
    {
        if (!auth()->check()) return;
        $article = Article::findOrFail($this->articleId);
        if (!$article->likes()->where('user_id', auth()->id())->exists()) {
            $article->likes()->create(['user_id' => auth()->id()]);
            $this->liked = true;
            $this->likeCount++;
        }
    }

    public function dislike()
    {
        if (!auth()->check()) return;
        $article = Article::findOrFail($this->articleId);
        $like = $article->likes()->where('user_id', auth()->id())->first();
        if ($like) {
            $like->delete();
            $this->liked = false;
            $this->likeCount--;
        }
    }

    public function toggleBookmark()
    {
        if (!auth()->check()) return;
        $article = Article::findOrFail($this->articleId);
        $bookmark = $article->bookmarks()->where('user_id', auth()->id())->first();
        if ($bookmark) {
            $bookmark->delete();
            $this->bookmarked = false;
        } else {
            $article->bookmarks()->create(['user_id' => auth()->id()]);
            $this->bookmarked = true;
        }
    }

    public function render()
    {
        return view('livewire.article-actions');
    }
}
