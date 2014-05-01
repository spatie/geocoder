<?php namespace Spatie\Geocoder;

use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind(
            'geocoder',
            'Spatie\Geocoder\Google\Geocoder'
        );
    }

}