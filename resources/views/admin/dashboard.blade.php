@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="border-b border-gray-200 pb-5">
        <h3 class="text-2xl font-semibold leading-6 text-gray-900">Dashboard</h3>
        <p class="mt-2 max-w-4xl text-sm text-gray-500">
            Selamat datang di dashboard admin The Indonesian Press. Berikut adalah ringkasan aktivitas website Anda.
        </p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Articles -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Total Artikel</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ number_format($stats['total_articles']) }}</dd>
            <div class="mt-2 flex items-center text-sm">
                <span class="text-green-600 font-medium">{{ $stats['published_articles'] }}</span>
                <span class="text-gray-500 ml-1">dipublikasi</span>
                <span class="text-gray-300 mx-1">•</span>
                <span class="text-yellow-600 font-medium">{{ $stats['draft_articles'] }}</span>
                <span class="text-gray-500 ml-1">draft</span>
            </div>
        </div>

        <!-- Total Users -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Total Users</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ number_format($stats['total_users']) }}</dd>
            <div class="mt-2 flex items-center text-sm">
                <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span class="text-gray-500 ml-1">pengguna terdaftar</span>
            </div>
        </div>

        <!-- Total Views -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Total Views</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ number_format($stats['total_views']) }}</dd>
            <div class="mt-2 flex items-center text-sm">
                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-gray-500 ml-1">total pembaca</span>
            </div>
        </div>

        <!-- Total Comments -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow border border-gray-200">
            <dt class="truncate text-sm font-medium text-gray-500">Komentar</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ number_format($stats['total_comments']) }}</dd>
            <div class="mt-2 flex items-center text-sm">
                <span class="text-red-600 font-medium">{{ $stats['pending_comments'] }}</span>
                <span class="text-gray-500 ml-1">menunggu persetujuan</span>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
        <!-- Article Growth Chart -->
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Pertumbuhan Artikel (2024)</h3>
                <p class="mt-1 text-sm text-gray-500">Jumlah artikel yang diterbitkan per bulan</p>
            </div>
            <div class="p-6">
                <canvas id="articleGrowthChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Top Categories -->
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Kategori Teratas</h3>
                <p class="mt-1 text-sm text-gray-500">Kategori dengan artikel terbanyak</p>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($topCategories as $category)
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $category->name }}</p>
                                <p class="text-sm text-gray-500">{{ $category->articles_count }} artikel</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="w-16 bg-gray-200 rounded-full h-2">
                                    <div class="h-2 rounded-full" style="width: {{ ($category->articles_count / $topCategories->max('articles_count')) * 100 }}%; background-color: #7E2320;"></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Recent Articles -->
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Artikel Terbaru</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($recentArticles as $article)
                    <div class="px-6 py-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : 
                                       ($article->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $article->title }}</p>
                                <p class="text-sm text-gray-500">{{ $article->user->name }} • {{ $article->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
                <a href="{{ route('admin.articles.index') }}" class="text-sm font-medium hover:underline" style="color: #7E2320;">
                    Lihat semua artikel →
                </a>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Pengguna Baru</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($recentUsers as $user)
                    <div class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <img class="h-8 w-8 rounded-full" 
                                     src="{{ $user->profile_picture ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=7F9CF5&background=EBF4FF' }}" 
                                     alt="">
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
                <a href="{{ route('admin.users.index') }}" class="text-sm font-medium hover:underline" style="color: #7E2320;">
                    Lihat semua pengguna →
                </a>
            </div>
        </div>

        <!-- Popular Articles -->
        <div class="bg-white shadow rounded-lg border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Artikel Populer</h3>
                <p class="text-sm text-gray-500">Bulan ini</p>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($popularArticles as $article)
                    <div class="px-6 py-4">
                        <div class="flex items-start justify-between">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $article->title }}</p>
                                <p class="text-sm text-gray-500">{{ $article->category->name }}</p>
                            </div>
                            <div class="flex-shrink-0 ml-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ number_format($article->view_count) }} views
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
                <a href="{{ route('admin.statistics') }}" class="text-sm font-medium hover:underline" style="color: #7E2320;">
                    Lihat statistik lengkap →
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Article Growth Chart dengan warna maroon
    const ctx = document.getElementById('articleGrowthChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Artikel',
                data: @json($articleGrowth),
                borderColor: '#7E2320',           // Warna garis maroon
                backgroundColor: 'rgba(126, 35, 32, 0.1)',  // Background dengan transparansi maroon
                tension: 0.1,
                fill: true,
                pointBackgroundColor: '#7E2320',  // Warna titik data
                pointBorderColor: '#7E2320',      // Border titik data
                pointHoverBackgroundColor: '#6B1F1C', // Warna titik saat hover
                pointHoverBorderColor: '#6B1F1C'      // Border titik saat hover
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});
</script>
@endsection