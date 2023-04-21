<?php

namespace Martian\EuroCurrencyExchange\Providers;

use Illuminate\Support\ServiceProvider;
use Martian\EuroCurrencyExchange\Classes\Builder;

class EuroCurrencyExchangeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'euro-currency-exchange');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'euro-currency-exchange');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(
            __DIR__ . '/../../routes/api.php'
        );

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/euro-currency-exchange.php' => config_path('euro-currency-exchange.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/euro-currency-exchange'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/euro-currency-exchange'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/euro-currency-exchange'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/euro-currency-exchange.php', 'euro-currency-exchange');

        // Register the main class to use with the facade
        $this->app->bind('euro-currency-exchange', function () {
            return new Builder();
        });
    }
}
