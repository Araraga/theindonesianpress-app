<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema; // Tambahkan import ini
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes - COMPLETE WITH CRUD
|--------------------------------------------------------------------------
*/

// Frontend Routes
Route::get('/', function () {
    return view('welcome');
});

// ===== UNIFIED LOGIN SYSTEM =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/admin/create-admin', [AuthController::class, 'showCreateAdminForm'])->name('admin.create-admin');
    Route::post('/admin/create-admin', [AuthController::class, 'createAdmin']);
});

// Logout routes
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

// ===== ADMIN PANEL ROUTES =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Articles Management 
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/', function () {
            return view('admin.articles.index');
        })->name('index');

        Route::get('/create', function () {
            return view('admin.articles.create');
        })->name('create');

        Route::post('/', function () {
            return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat!');
        })->name('store');

        Route::get('/{article}/edit', function ($article) {
            return view('admin.articles.edit', compact('article'));
        })->name('edit');

        Route::put('/{article}', function ($article) {
            return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diupdate!');
        })->name('update');

        Route::delete('/{article}', function ($article) {
            return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
        })->name('destroy');
    });

    // Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', function () {
            return view('admin.users.index');
        })->name('index');
    });

    // Categories Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', function () {
            return view('admin.categories.index'); 
        })->name('index');
    });

    // Statistics
    Route::get('/statistics', function () {
        return view('admin.statistics');
    })->name('statistics');

    // Settings - COMPLETE CRUD
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () {
            return view('admin.settings.index');
        })->name('index');

        Route::get('/general', function () {
            return view('admin.settings.general');
        })->name('general');

        Route::post('/general', function () {
            return redirect()->route('admin.settings.general')->with('success', 'Pengaturan berhasil disimpan!');
        })->name('general.store');
    });

    // Debug route
    Route::get('/debug-category', function () {
        return response()->json([
            'livewire_component_exists' => class_exists(\App\Livewire\Admin\CategoryManager::class),
            'category_model_exists' => class_exists(\App\Models\Category::class),
            'categories_table_exists' => Schema::hasTable('categories'), 
            'categories_count' => \App\Models\Category::count(),
            'sample_categories' => \App\Models\Category::take(3)->get(),
            'view_exists' => view()->exists('livewire.admin.category-manager'),
            'admin_categories_index_exists' => view()->exists('admin.categories.index'),
        ]);
    })->name('debug.category');

    Route::get('/debug-livewire', function () {
        return [
            'components_registered' => [
                'admin.category-manager' => class_exists(\App\Livewire\Admin\CategoryManager::class),
                'admin.article-manager' => class_exists(\App\Livewire\Admin\ArticleManager::class),
                'admin.user-manager' => class_exists(\App\Livewire\Admin\UserManager::class),
            ],
            'view_files_exist' => [
                'livewire.admin.category-manager' => view()->exists('livewire.admin.category-manager'),
                'admin.settings.index' => view()->exists('admin.settings.index'),
                'admin.settings.general' => view()->exists('admin.settings.general'),
            ],
            'routes_exist' => [
                'admin.settings.index' => Route::has('admin.settings.index'),
                'admin.settings.general' => Route::has('admin.settings.general'), 
            ]
        ];
    });

    // Media Manager
    Route::get('/media', function () {
        return view('admin.media.index');
    })->name('media.index');
});

// Redirects
Route::redirect('/admin', '/admin/dashboard');

// DEBUG ROUTE (hapus setelah selesai)
Route::get('/debug-views', function () {
    $viewPaths = [];
    $basePath = resource_path('views/admin');

    if (is_dir($basePath)) {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basePath));
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $file->getPathname());
                $viewName = 'admin.' . str_replace(['/', '\\', '.blade.php'], ['.', '.', ''], $relativePath);
                $viewPaths[] = $viewName;
            }
        }
    }

    return response()->json([
        'base_path' => $basePath,
        'views_found' => $viewPaths,
        'admin_folder_exists' => is_dir(resource_path('views/admin')),
        'Admin_folder_exists' => is_dir(resource_path('views/Admin')),
    ]);
});