<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function ($user) {
            return $user->role == 0;
        });
        Gate::define('pengelola', function ($user) {
            // return $user->role == 1;
            return in_array($user->role, [0, 1]);
        });
        Gate::define('kasir', function ($user) {
            // return $user->role == 2;
            return in_array($user->role, [0, 2]);
        });
    }
}
