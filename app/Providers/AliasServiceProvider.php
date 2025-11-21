<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AliasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Get the AliasLoader instance
        $loader = AliasLoader::getInstance();

        $loader->alias('DzHelper', 'App\Helpers\DzHelper');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
