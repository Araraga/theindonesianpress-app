<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class ArticleManager extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $categoryFilter = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function deleteArticle($articleId)
    {
        $article = Article::find($articleId);
        if ($article) {
            $article->delete();
            session()->flash('success', 'Artikel berhasil dihapus.');
        }
    }

    public function changeStatus($articleId, $status)
    {
        $article = Article::find($articleId);
        if ($article) {
            $article->update(['status' => $status]);
            session()->flash('success', 'Status artikel berhasil diubah.');
        }
    }

    public function render()
    {
        $query = Article::with(['user', 'category'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            });

        $articles = $query
            ->orderBy($this->sortBy ?? 'created_at', $this->sortDirection ?? 'desc')
            ->paginate(10);

        $categories = Category::orderBy('name')->get();
        return view('livewire.admin.article-manager', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}