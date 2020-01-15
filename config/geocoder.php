<?php

return [
    /*
     * The api key used when sending Geocoding requests to Google.
     */
    'key' => env('GOOGLE_MAPS_GEOCODING_API_KEY', ''),

    /*
     * The language param used to set response translations for textual data.
     *
     * More info: https://developers.google.com/maps/faq#languagesupport
     */

    'language' => '',

    /*
     * The region param used to finetune the geocoding process.
     *
     * More info: https://developers.google.com/maps/documentation/geocoding/intro#RegionCodes
     */
    'region' => '',

    /*
     * The bounds param used to finetune the geocoding process.
     *
     * More info: https://developers.google.com/maps/documentation/geocoding/intro#Viewports
     */
    'bounds' => '',

    /*
     * The country param used to limit results to a specific country.
     *
     * More info: https://developers.google.com/maps/documentation/javascript/geocoding#GeocodingRequests
     */
    'country' => '',

    /** Cache */
    'cache' => [
        /*
         * By default looking caching is disabled, you may enable it to speed up performance and reduce api hits.
         * Default: false
         */
        'enabled' => false,

        /*
         * By default lookups are cached for 24 hours to speed up performance and reduce api hits.
         * Default: 24 hours ( 60 seconds * 60 minutes * 24 hours), 86400
         */
        'expiry' => (60 * 60 * 24),

        /*
         * The cache prefix key used to prefix stored lookups.
         * Default: _geocoder:
         */
        'prefix' => '_geocoder:',

        /*
         * You may optionally indicate a specific cache driver to use for Geocoder caching
         * using any of the `store` drivers listed in the cache.php config file.
         * Using null here means to use the `default` set in cache.php.
         * Default: null
         */
        'driver' => null,
    ],
];
