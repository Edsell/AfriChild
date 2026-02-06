<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         Route::resourceParameters([
        'cta' => 'cta',
        'mission' => 'mission',
    ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Gate::define('manage-users', function ($user) {
        return $user && strtolower(trim((string) $user->role)) === 'admin';
    });
    }
}
