<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    // Ganti register agar pakai Blade, bukan Volt
    Route::get('register', function() {
        return view('auth.register');
    })->name('register');
    Route::post('register', [App\Http\Controllers\Auth\AuthController::class, 'register']);
    Route::get('login', function() {
        return view('auth.login');
    })->name('login');
    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    // ...jika ingin, bisa tambahkan route login custom juga
    // Volt::route('forgot-password', 'auth.forgot-password')->name('password.request');
    // Volt::route('reset-password/{token}', 'auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
