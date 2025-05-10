<?php

namespace App\Providers;

use App\Models\Phone;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
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
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        Gate::define('access-admin', function ($user) {
            return in_array($user->role, ['admin']);
        });

        View::composer('*', function ($view) {
            $phone = Phone::first();
            $view->with('whatsapp', $phone?->whatsapp ?? '6280000000000');
        });
    }
}
