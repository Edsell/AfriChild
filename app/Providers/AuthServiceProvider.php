<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerPolicies(); // ✅ important

        Gate::define('manage-users', function ($user) {
            return $user && strtolower(trim((string) $user->role)) === 'admin';
        });
    }
}
