@extends('admin.layout')

@section('title', 'Statistik')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="border-b border-gray-200 pb-5">
        <h3 class="text-2xl font-semibold leading-6 text-gray-900">Statistik Website</h3>
        <p class="mt-2 max-w-4xl text-sm text-gray-500">
            Analisis mendalam tentang performa website The Indonesian Press.
        </p>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Page Views</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format(\App\Models\Article::sum('view_count')) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Registered Users</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format(\App\Models\User::where('role', 'user')->count()) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Comments</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format(\App\Models\Comment::count()) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg border border-gray-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Likes</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format(\App\Models\Like::count()) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <!-- Most Popular Articles -->
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Artikel Paling Populer</h3>
            </div>
            <div class="p-6">
                @php
                    $popularArticles = \App\Models\Article::with(['user', 'category'])
                        ->orderBy('view_count', 'desc')
                        ->take(10)
                        ->get();
                @endphp
                <div class="space-y-4">
                    @foreach($popularArticles as $index => $article)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <span class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center text-sm font-medium text-gray-600">
                                    {{ $index + 1 }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Str::limit($article->title, 40) }}</p>
                                    <p class="text-sm text-gray-500">{{ $article->category->name }}</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ number_format($article->view_count) }} views
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Category Performance -->
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Performa Kategori</h3>
            </div>
            <div class="p-6">
                @php
                    $categoryStats = \App\Models\Category::withCount('articles')
                        ->with('articles')
                        ->get()
                        ->map(function($category) {
                            return [
                                'name' => $category->name,
                                'article_count' => $category->articles_count,
                                'total_views' => $category->articles->sum('view_count')
                            ];
                        })
                        ->sortByDesc('total_views')
                        ->take(8);
                @endphp
                <div class="space-y-4">
                    @foreach($categoryStats as $stat)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $stat['name'] }}</p>
                                <p class="text-sm text-gray-500">{{ $stat['article_count'] }} artikel</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ number_format($stat['total_views']) }}</p>
                                <p class="text-sm text-gray-500">total views</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white shadow rounded-lg border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Aktivitas Terbaru</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @php
                $recentActivities = \App\Models\ActivityLog::with('user')
                    ->latest()
                    ->take(10)
                    ->get();
            @endphp
            @foreach($recentActivities as $activity)
                <div class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <img class="h-8 w-8 rounded-full" 
                             src="{{ $activity->user->profile_picture ?? 'https://ui-avatars.com/api/?name='.urlencode($activity->user->name).'&color=7F9CF5&background=EBF4FF' }}" 
                             alt="">
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-gray-900">
                                <span class="font-medium">{{ $activity->user->name }}</span>
                                {{ $activity->description }}
                            </p>
                            <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium 
                                {{ $activity->action === 'admin_login' ? 'bg-green-100 text-green-800' : 
                                   ($activity->action === 'admin_logout' ? 'bg-red-100 text-red-800' : 
                                    'bg-blue-100 text-blue-800') }}">
                                {{ str_replace('_', ' ', ucfirst($activity->action)) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection