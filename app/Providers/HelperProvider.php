<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Helper;

class HelperProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('helper', function (){
           return new Helper();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
