<?php

namespace Vinelab\Assistant;

use Illuminate\Support\ServiceProvider;

class AssistantServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/assist.php' => config_path('assist.php'),
        ], 'assist');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('vinelab.assistant.formatter', function () {
            return new Formatter();
        });

        $this->app->booting(function () {

            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Formatter', 'Vinelab\Assistant\Facades\Formatter');
        });

        $this->app->singleton('vinelab.assistant.devicedetector', function () {
            return new DeviceDetector();
        });

        $this->app->booting(function () {

            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('DeviceDetector', 'Vinelab\Assistant\Facades\DeviceDetector');
        });

        $this->app->singleton('vinelab.assistant.generator', function () {
            return new Generator();
        });

        $this->app->booting(function () {

            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Generator', 'Vinelab\Assistant\Facades\Generator');
        });

        $this->app->singleton('vinelab.assistant.address', function () {
            return new Address();
        });

        $this->app->booting(function () {

            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Address', 'Vinelab\Assistant\Facades\Address');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
