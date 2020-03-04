<?php

namespace Spatie\Geocoder\Tests;

use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Geocoder\GeocoderServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadEnvironmentVariables();
    }

    protected function getPackageProviders($app)
    {
        return [GeocoderServiceProvider::class];
    }

    protected function loadEnvironmentVariables()
    {
        if (! file_exists(__DIR__.'/../.env')) {
            return;
        }
        $dotenv = Dotenv::createImmutable(__DIR__.'/..');

        $dotenv->load();
    }
}
