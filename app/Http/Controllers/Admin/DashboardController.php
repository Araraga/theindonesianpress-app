<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_categories' => Category::count(),
            'total_comments' => Comment::count(),
            'pending_comments' => Comment::where('is_approved', false)->count(),
            'total_views' => Article::sum('view_count'),
            'total_likes' => Like::count(),
        ];

        $monthlyArticles = Article::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $articleGrowth = [];
        for ($i = 1; $i <= 12; $i++) {
            $articleGrowth[] = $monthlyArticles[$i] ?? 0;
        }

        $topCategories = Category::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->take(5)
            ->get();

        $recentArticles = Article::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        $popularArticles = Article::with(['user', 'category'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'articleGrowth',
            'topCategories',
            'recentArticles',
            'recentUsers',
            'popularArticles'
        ));
    }
}