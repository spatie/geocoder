<?php namespace Spatie\Geocoder;

use Illuminate\Support\Facades\Facade;

class GeocoderFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'geocoder';
    }

}
