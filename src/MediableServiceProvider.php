<?php
namespace Nh\Mediable;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

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

        // VIEWS
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'media');

        // TRANSLATIONS
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mediable');

        // BLADES
        Blade::component('media-fieldset', \Nh\AccessControl\View\Components\MediaFieldset::class);

        // VENDORS
        $this->publishes([
            __DIR__.'/../database/migrations/2020_04_16_000001_create_media_table.php' => base_path('database/migrations/2020_04_16_000001_create_media_table.php')
        ], 'mediable');


    }
}
