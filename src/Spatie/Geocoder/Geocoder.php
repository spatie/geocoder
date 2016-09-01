<?php

namespace Spatie\Geocoder;

interface Geocoder
{
    /**
     * Get the coordinates for a query.
     *
     * @param string $query
     *
     * @return array
     */
    const RESULT_NOT_FOUND = 'NOT FOUND';

    public function getCoordinatesForQuery($query, $language = null, $region = null, $api_key = null);
}
