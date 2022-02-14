<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('apphelper', function()
        {
            return new \App\HelperClass\AppHelper();
        });

        App::bind('viewhelper', function()
        {
            return new \App\HelperClass\ViewHelper();
        });
    }
}
