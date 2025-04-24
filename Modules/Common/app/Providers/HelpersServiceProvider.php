<?php

namespace Modules\Common\app\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        foreach (glob(base_path() . '/Modules/Common/app/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
