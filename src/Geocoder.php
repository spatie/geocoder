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

    /** @var string */
    protected $country;

    /** @var bool */
    protected $cacheEnabled;

    /** @var int */
    protected $cacheExpiry;

    /** @var string */
    protected $cachePrefix;

    /** @var string */
    protected $cacheDriver;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->setCache();
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

    public function setCountry(string $country)
    {
        $this->country = $country;

        return $this;
    }

    public function setCache(bool $cacheEnabled = null, int $cacheExpiry = null, string $cachePrefix = null, string $cacheDriver = null)
    {
        $this->cacheEnabled = is_null($cacheEnabled) ? config('geocoder.cache.enabled') : $cacheEnabled;
        $this->cacheExpiry = is_null($cacheExpiry) ? config('geocoder.cache.expiry') : $cacheExpiry;
        $this->cachePrefix = is_null($cachePrefix) ? config('geocoder.cache.prefix') : $cachePrefix;
        $this->cacheDriver = is_null($cacheDriver) ? config('geocoder.cache.driver') : $cacheDriver;

        return $this;
    }

    public function getCoordinatesForAddress(string $address): array
    {
        if (empty($address)) {
            return $this->emptyResponse();
        }

        if ($this->cacheEnabled) {
            return $this->getCoordinatesForAddressCached($address);
        } else {
            return $this->getCoordinatesForAddressUncached($address);
        }
    }

    public function getCoordinatesForAddressCached(string $address): array
    {
        return cache()->driver($this->cacheDriver)->remember($this->cachePrefix.md5($address), $this->cacheExpiry, function () use ($address) {
            return $this->getCoordinatesForAddressUncached($address);
        });
    }

    public function getCoordinatesForAddressUncached(string $address): array
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

        return $this->formatResponse($geocodingResponse);
    }

    public function getAddressForCoordinates(float $lat, float $lng): array
    {
        if ($this->cacheEnabled) {
            return $this->getAddressForCoordinatesCached($lat, $lng);
        } else {
            return $this->getAddressForCoordinatesUncached($lat, $lng);
        }
    }

    public function getAddressForCoordinatesCached(float $lat, float $lng): array
    {
        return cache()->driver($this->cacheDriver)->remember($this->cachePrefix.md5("{$lat}:{$lng}"), $this->cacheExpiry, function () use ($lat, $lng) {
            return $this->getAddressForCoordinatesUncached($lat, $lng);
        });
    }

    public function getAddressForCoordinatesUncached(float $lat, float $lng): array
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

        return $this->formatResponse($reverseGeocodingResponse);
    }

    protected function formatResponse($response): array
    {
        return [
            'lat' => $response->results[0]->geometry->location->lat,
            'lng' => $response->results[0]->geometry->location->lng,
            'accuracy' => $response->results[0]->geometry->location_type,
            'formatted_address' => $response->results[0]->formatted_address,
            'viewport' => $response->results[0]->geometry->viewport,
            'address_components' => $response->results[0]->address_components,
            'place_id' => $response->results[0]->place_id,
        ];
    }

    protected function getRequestPayload(array $parameters): array
    {
        $parameters = array_merge([
            'key' => $this->apiKey,
            'language' => $this->language,
            'region' => $this->region,
            'bounds' => $this->bounds,
        ], $parameters);

        if ($this->country) {
            $parameters = array_merge(
                $parameters,
                ['components' => 'country:'.$this->country]
            );
        }

        return ['query' => $parameters];
    }

    protected function emptyResponse(): array
    {
        return [
            'lat' => 0,
            'lng' => 0,
            'accuracy' => static::RESULT_NOT_FOUND,
            'formatted_address' => static::RESULT_NOT_FOUND,
            'viewport' => static::RESULT_NOT_FOUND,
        ];
    }
}
