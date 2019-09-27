<?php

namespace Motomedialab\RuntimeStore;

use Illuminate\Support\ServiceProvider;

class RuntimeStoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('store', function () {
            return new RuntimeStore;
        });
    }
}
