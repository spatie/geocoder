<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Maps API key
    |--------------------------------------------------------------------------
    |   You need to set the API key, which is required to send requests
    |   to Google's maps API
    |   More info: https://developers.google.com/maps/documentation/geocoding/intro#geocoding
    */

    'key' => env('GOOGLE_MAPS_GEOCODING_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Language param [OPTIONAL]
    |--------------------------------------------------------------------------
    |   The language param used to set response translations for textual data
    |   (e.g. "formatted_address" field).
    |   More info: https://developers.google.com/maps/faq#languagesupport
    |
    */

    'language' => null,

    /*
    |--------------------------------------------------------------------------
    | Region param [OPTIONAL]
    |--------------------------------------------------------------------------
    |   The region param used to finetune the geocoding process.
    |   More info: https://developers.google.com/maps/documentation/geocoding/intro#RegionCodes
    |
    */

    'region' => null,

];
