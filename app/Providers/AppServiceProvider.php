<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production') && ! empty(config('app.url'))) {
            $scheme = parse_url((string) config('app.url'), PHP_URL_SCHEME);

            if ($scheme === 'https') {
                URL::forceScheme('https');
            }
        }
    }
}
