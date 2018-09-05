<?php

namespace Spatie\Geocoder;

use GuzzleHttp\Client;
use Spatie\Geocoder\Exceptions\CouldNotGeocode;

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

    /** @var string */
    protected $bounds;

    /** @var bool */
    protected $addressComponents;

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

    public function setBounds(string $bounds)
    {
        $this->bounds = $bounds;

        return $this;
    }

    public function withAddressComponents()
    {
        $this->addressComponents = true;

        return $this;
    }

    public function getCoordinatesForAddress(string $address): array
    {
        if (empty($address)) {
            return $this->emptyResponse();
        }

        $payload = $this->getRequestPayload(compact('address'));

        $response = $this->client->request('GET', $this->endpoint, $payload);

        if ($response->getStatusCode() !== 200) {
            throw CouldNotGeocode::couldNotConnect();
        }

        $geocodingResponse = json_decode($response->getBody());

        if (! empty($geocodingResponse->error_message)) {
            throw CouldNotGeocode::serviceReturnedError($geocodingResponse->error_message);
        }

        if (! count($geocodingResponse->results)) {
            return $this->emptyResponse();
        }

        if ($this->addressComponents) {
            return $this->formatResponseWithAddressComponents($geocodingResponse);
        } else {
            return $this->formatResponse($geocodingResponse);
        }
    }

    public function getAddressForCoordinates(float $lat, float $lng): array
    {
        $payload = $this->getRequestPayload([
            'latlng' => "$lat,$lng",
        ]);

        $response = $this->client->request('GET', $this->endpoint, $payload);

        if ($response->getStatusCode() !== 200) {
            throw CouldNotGeocode::couldNotConnect();
        }

        $reverseGeocodingResponse = json_decode($response->getBody());

        if (! empty($reverseGeocodingResponse->error_message)) {
            throw CouldNotGeocode::serviceReturnedError($reverseGeocodingResponse->error_message);
        }

        if (! count($reverseGeocodingResponse->results)) {
            return $this->emptyResponse();
        }

        if ($this->addressComponents) {
            return $this->formatResponseWithAddressComponents($reverseGeocodingResponse);
        } else {
            return $this->formatResponse($reverseGeocodingResponse);
        }
    }

    protected function formatResponse($response): array
    {
        return [
            'lat' => $response->results[0]->geometry->location->lat,
            'lng' => $response->results[0]->geometry->location->lng,
            'accuracy' => $response->results[0]->geometry->location_type,
            'formatted_address' => $response->results[0]->formatted_address,
            'viewport' => $response->results[0]->geometry->viewport
        ];
    }

    protected function formatResponseWithAddressComponents($response): array
    {
        if($response->results[0]->geometry->location_type == 'ROOFTOP')
        {
            return [
                'lat' => $response->results[0]->geometry->location->lat,
                'lng' => $response->results[0]->geometry->location->lng,
                'accuracy' => $response->results[0]->geometry->location_type,
                'formatted_address' => $response->results[0]->formatted_address,
                'viewport' => $response->results[0]->geometry->viewport,
                'address_components' => $response->results[0]->address_components
            ];
        }
        else
        {
            return [
                'lat' => $response->results[0]->geometry->location->lat,
                'lng' => $response->results[0]->geometry->location->lng,
                'accuracy' => $response->results[0]->geometry->location_type,
                'formatted_address' => $response->results[0]->formatted_address,
                'viewport' => $response->results[0]->geometry->viewport,
                'address_components' => null
            ];
        }
    }

    protected function getRequestPayload(array $parameters): array
    {
        $parameters = array_merge([
            'key' => $this->apiKey,
            'language' => $this->language,
            'region' => $this->region,
            'bounds' => $this->bounds,
        ], $parameters);

        return ['query' => $parameters];
    }

    protected function emptyResponse(): array
    {
        if($this->addressComponents) {
            return [
                'lat' => 0,
                'lng' => 0,
                'accuracy' => static::RESULT_NOT_FOUND,
                'formatted_address' => static::RESULT_NOT_FOUND,
                'viewport' => static::RESULT_NOT_FOUND,
                'address_components' => static::RESULT_NOT_FOUND,
            ];
        } else {
            return [
                'lat' => 0,
                'lng' => 0,
                'accuracy' => static::RESULT_NOT_FOUND,
                'formatted_address' => static::RESULT_NOT_FOUND,
                'viewport' => static::RESULT_NOT_FOUND,
            ];
        }
    }
}
