<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request): ?string
    {
        // Cek apakah request bukan untuk API
        if (! $request->expectsJson()) {
            // Jika URL yang diakses berada di dalam route prefix 'admin' atau 'admin/*'
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login'); // redirect ke route admin login
            }

            // Jika kamu punya route login biasa (non-admin), bisa tambahkan di sini
            return route('login'); // fallback (optional, aman walau route ini tidak ada)
        }

        return null;
    }
}
