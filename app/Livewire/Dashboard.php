<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\Category;

class Dashboard extends Component
{
    public $selectedCategory;
    public $articles;
    public $headline;
    public $top3;
    public $icymi;
    public $categories;

    public function mount()
    {
        $this->selectedCategory = request()->get('category');
        $this->categories = Category::orderBy('name')->get();
        $query = Article::with('category');
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
            $this->articles = $query->latest()->get();
        } else {
            $this->articles = $query->inRandomOrder()->get();
        }
        $this->headline = Article::with('category')->orderByDesc('view_count')->first();
        $this->top3 = Article::with('category')->orderByDesc('view_count')->take(3)->get();
        $this->icymi = Article::with('category')->inRandomOrder()->take(3)->get();
    }

    public function render()
    {
        $categories = Category::orderBy('name')->get();
        return view('livewire.dashboard', [
            'categories' => $categories,
        ]);
    }
}
