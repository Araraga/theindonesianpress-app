<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register Livewire Components
        Livewire::component('admin.category-manager', \App\Livewire\Admin\CategoryManager::class);
        Livewire::component('admin.article-manager', \App\Livewire\Admin\ArticleManager::class);
        Livewire::component('admin.user-manager', \App\Livewire\Admin\UserManager::class);

        // View composer: inject $categories ke header
        View::composer('components.header', function ($view) {
            $view->with('categories', Category::orderBy('name')->get());
        });
    }
}
