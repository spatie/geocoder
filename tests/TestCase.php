<?php

namespace Spatie\Geocoder\Tests;

use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadEnvironmentVariables();
    }

    protected function loadEnvironmentVariables()
    {
        if (! file_exists(__DIR__.'/../.env')) {
            return;
        }

        $dotenv = Dotenv::create(__DIR__.'/..');

        $dotenv->load();
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('cache.default', 'array');
        $app['config']->set('cache.prefix', 'spatie_tests---');

        $app['config']->set('geocoder.cache.enabled', false);
        $app['config']->set('geocoder.cache.expiry', 86400);
        $app['config']->set('geocoder.cache.prefix', '_geocoder:');
        $app['config']->set('geocoder.cache.driver', 'array');
    }
}
