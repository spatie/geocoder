<?php

namespace Spatie\Geocoder\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase
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
}
