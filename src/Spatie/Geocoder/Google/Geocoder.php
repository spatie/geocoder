<?php

namespace Spatie\Geocoder\Google;

use Exception;
use GuzzleHttp\Client;
use Spatie\Geocoder\Geocoder as GeocoderInterface;

class Geocoder implements GeocoderInterface
{
    /**
     * The HTTP client.
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Google Maps API endpoint.
     * @var string
     */
    protected $endpoint = 'https://maps.googleapis.com/maps/api/geocode/json';

    /**
     * Google Maps API Key.
     * @var string
     */
    protected $key;

    /**
     * The language response translation.
     * @var string
     */
    protected $language;

    /**
     * The region code used for fine tune the geocoding result.
     * @var string
     */
    protected $region;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the coordinates for a query.
     *
     * @param string $query
     *
     * @return array
     *
     * @throws Exception
     */
    public function getCoordinatesForQuery($query, $api_key = null, $lang = null, $reg = null)
    {
        if ($query == '') {
            return false;
        }

        $request = $this->client->createRequest('GET', $this->endpoint);
        $requestQuery = $request->getQuery();

        if ($api_key) {
            $this->key = $api_key;
        }

        if ($lang) {
            $this->language = $lang;
        }

        if ($reg) {
            $this->region = $reg;
        }

        if ($this->language) {
            $requestQuery->set('key', $this->language);
        }

        if ($this->region) {
            $requestQuery->set('region', $this->region);   
        }

        $requestQuery->set('address', $query);

        $response = $this->client->send($request);

        if ($response->getStatusCode() != 200) {
            throw new Exception('could not connect to googleapis.com/maps/api');
        }

        $fullResponse = $response->json();

        if (! count($fullResponse['results'])) {
            return [
                'lat' => 0,
                'lng' => 0,
                'accuracy' => self::RESULT_NOT_FOUND,
                'formatted_address' => self::RESULT_NOT_FOUND,
            ];
        }

        return [
            'lat' => $fullResponse['results'][0]['geometry']['location']['lat'],
            'lng' => $fullResponse['results'][0]['geometry']['location']['lng'],
            'accuracy' => $fullResponse['results'][0]['geometry']['location_type'],
            'formatted_address' => $fullResponse['results'][0]['formatted_address'],
        ];
    }

    /**
     * Set the API key param for the request.
     * @param string $k the key
     */
    public function setKey($k)
    {
        $this->key = $k;

        return $this;
    }

    /**
     * Set the language param for the request.
     * @param string $l the language code
     */
    public function setLanguage($l)
    {
        $this->language = $l;

        return $this;
    }

    /**
     * Set the region param for the request.
     * @param string $r the region code
     */
    public function setRegion($r)
    {
        $this->region = $r;

        return $this;
    }
}
