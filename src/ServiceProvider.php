<?php

namespace Koraycicekciogullari\HydroPage;

/**
 * Class ServiceProvider
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/../config/hydro-page.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('hydro-page.php'),
        ], 'config');
        $this->loadRoutesFrom(__DIR__.'/Routes/page-route.php');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'hydro-page'
        );
    }
}
