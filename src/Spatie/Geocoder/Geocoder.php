<?php namespace Spatie\Geocoder;

interface Geocoder {

    /**
     *
     * Get the coordinates for a query
     *
     * @param string $query
     * @return array
     */
    CONST RESULT_NOT_FOUND = 'NOT FOUND';

    public function getCoordinatesForQuery($query);
}