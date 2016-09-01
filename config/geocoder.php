<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Maps API key [REQUIRED]
    |--------------------------------------------------------------------------
    |   You need to set the API key, which is required to send requests
    |   to Google's maps API
    |   Please read: https://developers.google.com/maps/documentation/geocoding/intro#geocoding
    */

    'key' => env('GOOGLE_MAPS_GEOCODING_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Language param [OPTIONAL]
    |--------------------------------------------------------------------------
    |   The language param used to set response translations for textual data
    |   (e.g. "formatted_address" field).
    |   Please read: https://developers.google.com/maps/faq#languagesupport
    |
    */

    'language' => 'it',

    /*
    |--------------------------------------------------------------------------
    | Region param [OPTIONAL]
    |--------------------------------------------------------------------------
    |   The region param used to fine tune the geocoding process.
    |   Please read: https://developers.google.com/maps/documentation/geocoding/intro#RegionCodes
    |
    */

    'region' => 'it',

];
