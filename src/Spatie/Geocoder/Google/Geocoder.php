<?php

namespace Spatie\Geocoder\Google;

use Exception;
use GuzzleHttp\Client;
use Spatie\Geocoder\Geocoder as GeocoderInterface;

class Geocoder implements GeocoderInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $endpoint = 'https://maps.googleapis.com/maps/api/geocode/json';

    /**
     * @var string
     */
    protected $apiKey;

    /**
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
     * @param string $apiKey the key
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @param string $language the language code
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @param string $region the region code
     *
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get the coordinates for a query.
     *
     * @param string $query
     *
     * @param null $apiKey
     * @param null $language
     * @param null $region
     * @return array
     *
     * @throws \Exception
     */
    public function getCoordinatesForQuery($query, $apiKey = null, $language = null, $region = null)
    {
        if ($query == '') {
            return false;
        }

        if ($apiKey) {
            $this->apiKey = $apiKey;
        }

        if ($language) {
            $this->language = $language;
        }

        if ($region) {
            $this->region = $region;
        }

        $request = $this->client->createRequest('GET', $this->endpoint);
        $requestQuery = $request->getQuery();

        if ($this->apiKey) {
            $requestQuery->set('key', $this->apiKey);
        }

        if ($this->language) {
            $requestQuery->set('language', $this->language);
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
}
