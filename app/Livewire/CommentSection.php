<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentSection extends Component
{
    public $body = '';
    public $articleId;
    public $editId = null;
    public $editBody = '';

    public function mount($articleId)
    {
        $this->articleId = $articleId;
    }

    public function submit()
    {
        $this->validate([
            'body' => 'required|string|max:500',
        ]);

        \App\Models\Comment::create([
            'user_id' => auth()->id(),
            'article_id' => $this->articleId,
            'content' => $this->body,
        ]);

        $this->body = '';
        // Tidak perlu emit reloadPage, biarkan Livewire re-render otomatis
    }

    public function delete($id)
    {
        $comment = \App\Models\Comment::findOrFail($id);
        if ($comment->user_id === auth()->id()) {
            $comment->delete();
        }
    }

    public function startEdit($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id === auth()->id()) {
            $this->editId = $id;
            $this->editBody = $comment->content;
        }
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editBody = '';
    }

    public function update()
    {
        $this->validate([
            'editBody' => 'required|string|max:500',
        ]);
        $comment = Comment::findOrFail($this->editId);
        if ($comment->user_id === auth()->id()) {
            $comment->content = $this->editBody;
            $comment->save();
        }
        $this->cancelEdit();
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => \App\Models\Comment::where('article_id', $this->articleId)->latest()->take(20)->get()
        ]);
    }
}
