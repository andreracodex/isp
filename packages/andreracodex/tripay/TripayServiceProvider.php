<?php

namespace Andreracodex\Tripay;

use Illuminate\Support\ServiceProvider;

class TripayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->make('Andreracodex\Tripay\TripayController');
        $this->loadViewsFrom(__DIR__.'/views', 'tripay');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        include __DIR__.'/routes.php';

        $this->publishes([
            __DIR__.'/../resources/views/backend/pages/tripay/' => resource_path('views/'),
        ]);
    }
}
