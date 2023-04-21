<?php

namespace Martian\EuroCurrencyExchange\Tests;

use Martian\EuroCurrencyExchange\Providers\EuroCurrencyExchangeServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            EuroCurrencyExchangeServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'EuroCurrencyExchange' => 'Martian\EuroCurrencyExchange\Facades\EuroCurrencyExchange',
        ];
    }

    /**
     * Get the base path for the package.
     *
     * @return string
     */
    protected function getPackageBasePath()
    {
        return __DIR__ . '/../';
    }

    /**
     * Get the base path for the package.
     *
     * @return string
     */
    protected function getPackagePath()
    {
        return __DIR__ . '/../../';
    }

    /**
     * Get the base path for the package.
     *
     * @return string
     */
    protected function getPackageConfigPath()
    {
        return __DIR__ . '/../../config/euro-currency-exchange.php';
    }

    /**
     * Get the base path for the package.
     *
     * @return string
     */
    protected function getPackageRoutePath()
    {
        return __DIR__ . '/../../routes/api.php';
    }

    /**
     * Get the base path for the package.
     *
     * @return string
     */
    protected function getPackageControllerPath()
    {
        return __DIR__ . '/../../src/Controllers/EuroCurrencyExchangeController.php';
    }
}