<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [ArticleController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('artikel/tulis', [\App\Http\Controllers\ArticleController::class, 'create'])->name('artikel.create');
    Route::post('artikel/tulis', [\App\Http\Controllers\ArticleController::class, 'store'])->name('artikel.store');
});

// Route untuk halaman detail berita
Route::get('/artikel/{id}', [App\Http\Controllers\ArticleController::class, 'show'])->name('artikel.show');

// Edit artikel
Route::get('/artikel/{id}/edit', [App\Http\Controllers\ArticleController::class, 'edit'])->middleware(['auth'])->name('artikel.edit');
Route::post('/artikel/{id}/update', [App\Http\Controllers\ArticleController::class, 'update'])->middleware(['auth'])->name('artikel.update');

// Hapus artikel (khusus penulis)
Route::delete('/artikel/{id}', [\App\Http\Controllers\ArticleController::class, 'destroy'])->middleware(['auth'])->name('artikel.destroy');

// Like & Dislike
Route::post('/artikel/{article}/like', [ArticleController::class, 'like'])->name('artikel.like');
Route::post('/artikel/{article}/dislike', [ArticleController::class, 'dislike'])->name('artikel.dislike');
// Komentar
Route::post('/artikel/{article}/comment', [ArticleController::class, 'comment'])->name('artikel.comment');
// Edit komentar
Route::post('/artikel/comment/{comment}/edit', [ArticleController::class, 'editComment'])->name('artikel.comment.edit');

// Bookmark
Route::post('/artikel/{article}/bookmark', [ArticleController::class, 'bookmark'])->name('artikel.bookmark');
Route::post('/artikel/{article}/unbookmark', [ArticleController::class, 'unbookmark'])->name('artikel.unbookmark');
Route::get('/bookmarks', [ArticleController::class, 'bookmarks'])->name('bookmarks');

// AJAX search judul artikel (autocomplete, JSON)
Route::get('/artikel/search', [ArticleController::class, 'searchTitles']);
// Halaman hasil pencarian
Route::get('/search-results', [ArticleController::class, 'search'])->name('search.results');

require __DIR__.'/auth.php';
