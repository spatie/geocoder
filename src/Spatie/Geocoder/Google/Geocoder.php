<?php

namespace Spatie\Geocoder\Google;

use Guzzle\Service\Client;
use Spatie\Geocoder\Geocoder as GeocoderInterface;

class Geocoder implements GeocoderInterface {

    /**
     * @var client
     */

    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     *
     * Get the coordinates for a query
     *
     * @param string $query
     * @return array
     * @throws \Exception
     */
    public function getCoordinatesForQuery($query)
    {

        if ($query == '') {
            return false;
        }

        $request = $this->client->get('http://maps.googleapis.com/maps/api/geocode/json');

        $request->getQuery()
            ->set('address', $query)
            ->set('sensor', 'false');


        $response = $request->send();
        if ($response->getStatusCode() != 200) {
            throw new \Exception('could not connect to googleapis.com/maps/api');
        }

        $fullResponse = $response->json();


        if (count($fullResponse['results'])) {
            $geocoderResult = [
                'lat'=> $fullResponse['results'][0]['geometry']['location']['lat'],
                'lng'=>$fullResponse['results'][0]['geometry']['location']['lng'],
                'accuracy' => $fullResponse['results'][0]['geometry']['location_type']
            ];
        }
        else {
            $geocoderResult = ['lat'=> 0, 'lng'=> 0, 'accuracy'=> self::RESULT_NOT_FOUND];
        }

        return $geocoderResult;
    }


} 