<?php
namespace Nh\Mediable;

use Illuminate\Support\ServiceProvider;

class MediableServiceProvider extends ServiceProvider
{

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // VENDORS
        $this->publishes([
            __DIR__.'/../database/migrations/2020_04_16_000001_create_media_table.php' => base_path('database/migrations/2020_04_16_000001_create_media_table.php'),
            __DIR__.'/../config/mediable.php' => config_path('mediable.php')
        ], 'mediable');

    }
}
