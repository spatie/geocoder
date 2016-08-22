<?php

namespace Spatie\Geocoder;

use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->publishes([__DIR__.'/../config/geocoder.php' => config_path('geocoder.php'),], 'config');
	}

    public function register()
    {
    	$this->mergeConfigFrom(__DIR__.'/../config/geocoder.php', 'geocoder');
    	
        $this->app->bind(
            'geocoder',
            'Spatie\Geocoder\Google\Geocoder'
        );
    }
}
