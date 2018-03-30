<?php

namespace Spatie\Geocoder\Exceptions;

use Exception;

class CouldNotGeocode extends Exception
{
    public static function couldNotConnect()
    {
        return new static('Could not connect to googleapis.com/maps/api');
    }

    public static function serviceReturnedError(string $message)
    {
        return new static("Geocoding failed because `{$message}`");
    }
}
