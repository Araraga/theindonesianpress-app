<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes - COMPLETE WITH CRUD
|--------------------------------------------------------------------------
*/

// Frontend Routes
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin');
        }
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

// Route User (fitur User)
Route::get('dashboard', \App\Livewire\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', function () {
        return view('livewire.settings.profile');
    })->name('settings.profile');
    Route::get('artikel/tulis', [ArticleController::class, 'create'])->name('artikel.create');
    Route::post('artikel/tulis', [ArticleController::class, 'store'])->name('artikel.store');
});
Route::get('/artikel/{id}', [ArticleController::class, 'show'])->name('artikel.show');
Route::get('/artikel/{id}/edit', [ArticleController::class, 'edit'])->middleware(['auth'])->name('artikel.edit');
Route::post('/artikel/{id}/update', [ArticleController::class, 'update'])->middleware(['auth'])->name('artikel.update');
Route::delete('/artikel/{id}', [ArticleController::class, 'destroy'])->middleware(['auth'])->name('artikel.destroy');
Route::post('/artikel/{article}/like', [ArticleController::class, 'like'])->name('artikel.like');
Route::post('/artikel/{article}/dislike', [ArticleController::class, 'dislike'])->name('artikel.dislike');
Route::post('/artikel/{article}/comment', [ArticleController::class, 'comment'])->name('artikel.comment');
Route::post('/artikel/comment/{comment}/edit', [ArticleController::class, 'editComment'])->name('artikel.comment.edit');
Route::post('/artikel/{article}/bookmark', [ArticleController::class, 'bookmark'])->name('artikel.bookmark');
Route::post('/artikel/{article}/unbookmark', [ArticleController::class, 'unbookmark'])->name('artikel.unbookmark');
Route::get('/bookmarks', [ArticleController::class, 'bookmarks'])->name('bookmarks');
Route::get('/artikel/search', [ArticleController::class, 'searchTitles']);
Route::get('/search-results', [ArticleController::class, 'search'])->name('search.results');

require __DIR__.'/auth.php';

// ===== UNIFIED LOGIN SYSTEM (fitur dashboard-admin) =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/admin/create-admin', [AuthController::class, 'showCreateAdminForm'])->name('admin.create-admin');
    Route::post('/admin/create-admin', [AuthController::class, 'createAdmin']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/admin/logout', [AuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

// ===== ADMIN PANEL ROUTES =====
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::prefix('articles')->name('articles.')->group(function () {
        Route::get('/', [ArticleController::class, 'adminIndex'])->name('index');
        Route::get('/create', function () { return view('admin.articles.create'); })->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        // Route edit dan update bisa diabaikan/disable karena edit.blade.php sudah dikosongkan
        // Route::get('/{article}/edit', ...)->name('edit');
        // Route::put('/{article}', ...)->name('update');
        Route::delete('/{article}', function ($article) {
            \App\Models\Article::findOrFail($article)->delete();
            return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
        })->name('destroy');
        Route::delete('/', function (\Illuminate\Http\Request $request) {
            $id = $request->input('article_id');
            if ($id) {
                \App\Models\Article::findOrFail($id)->delete();
            }
            return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
        })->name('delete.bulk');
    });
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', function () { return view('admin.users.index'); })->name('index');
    });
    // Route kategori dinonaktifkan
    // Route::prefix('categories')->name('categories.')->group(function () {
    //     Route::get('/', function () { return view('admin.categories.index'); })->name('index');
    // });
    Route::get('/statistics', function () { return view('admin.statistics'); })->name('statistics');
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', function () { return view('admin.settings.index'); })->name('index');
        Route::get('/general', function () { return view('admin.settings.general'); })->name('general');
        Route::post('/general', function () { return redirect()->route('admin.settings.general')->with('success', 'Pengaturan berhasil disimpan!'); })->name('general.store');
    });
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
    Route::get('/media', function () { return view('admin.media.index'); })->name('media.index');
});
Route::redirect('/admin', '/admin/dashboard');
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
Route::get('/settings/password', function () {
    return view('livewire.settings.password');
})->middleware(['auth'])->name('settings.password');

Route::post('/settings/password', function (Request $request) {
    $request->validate([
        'current_password' => ['required'],
        'new_password' => ['required', 'min:8', 'confirmed'],
    ]);

    if (!Hash::check($request->current_password, auth()->user()->password)) {
        return back()->with('error', 'Password lama anda salah.');
    }

    auth()->user()->update([
        'password' => bcrypt($request->new_password),
    ]);

    return back()->with('success', 'Password berhasil diubah.');
})->middleware(['auth'])->name('settings.password.update');
