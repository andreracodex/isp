<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        Blade::directive('currency', function ($expression)
        { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });

        Blade::directive('number', function ($expression){ return "<?php echo number_format($expression,0,',','.'); ?>"; });

        Blade::directive('decimal', function ($expression){ return "<?php echo number_format($expression,3,',','.'); ?>"; });

    }
}
