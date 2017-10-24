<?php

namespace Spatie\Geocoder;

use Exception;
use GuzzleHttp\Client;
use Spatie\Geocoder\Geocoder as GeocoderInterface;

class Geocoder
{
    const RESULT_NOT_FOUND = 'result_not_found';

    /** @var \GuzzleHttp\Client */
    protected $client;

    /** @var string */
    protected $endpoint = 'https://maps.googleapis.com/maps/api/geocode/json';

    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $language;

    /** @var string */
    protected $region;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setLanguage(string $language)
    {
        $this->language = $language;

        return $this;
    }

    public function setRegion(string $region)
    {
        $this->region = $region;

        return $this;
    }

    public function getCoordinatesForAddress(string $address): array
    {
        if (empty($address)) {
            return $this->emptyResponse();
        }

        $payload = $this->getRequestPayload($address);

        $response = $this->client->request('GET', $this->endpoint, $payload);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('could not connect to googleapis.com/maps/api');
        }

        $geocodingResponse = json_decode($response->getBody());

        if (!count($geocodingResponse->results)) {
            return $this->emptyResponse();
        }

        return [
            'lat' => $geocodingResponse->results[0]->geometry->location->lat,
            'lng' => $geocodingResponse->results[0]->geometry->location->lng,
            'accuracy' => $geocodingResponse->results[0]->geometry->location_type,
            'formatted_address' => $geocodingResponse->results[0]->formatted_address,
        ];

    }

    protected function getRequestPayload(string $address): array
    {
        $parameters =  array_filter([
            'address' => $address,
            'key' => $this->apiKey,
            'language' => $this->language,
            'region' => $this->region,
        ]);

        return ['query' => $parameters];
    }

    protected function emptyResponse(): array
    {
        return [
            'lat' => 0,
            'lng' => 0,
            'accuracy' => static::RESULT_NOT_FOUND,
            'formatted_address' => static::RESULT_NOT_FOUND,
        ];
    }
}
