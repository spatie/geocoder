<?php

namespace Spatie\Geocoder\Tests;

use GuzzleHttp\Client;
use Spatie\Geocoder\Geocoder;

class GeocoderTest extends TestCase
{
    /** @var \Spatie\Geocoder\Geocoder */
    protected $geocoder;

    public function setUp(): void
    {
        parent::setUp();

        $client = new Client();

        $this->geocoder = new Geocoder($client);

        $apiKey = env('GOOGLE_API_KEY');

        if (! $apiKey) {
            $this->markTestSkipped('No Google API key was provided.');

            return;
        }

        $this->geocoder->setApiKey($apiKey);
    }

    /** @test */
    public function it_can_geocode_a_city()
    {
        $result = $this->geocoder->getCoordinatesForAddress('Antwerp');

        $this->assertArrayHasKey('lat', $result);
        $this->assertArrayHasKey('lng', $result);
        $this->assertArrayHasKey('accuracy', $result);
        $this->assertArrayHasKey('formatted_address', $result);
        $this->assertArrayHasKey('viewport', $result);
    }

    /** @test */
    public function it_can_geocode_a_city_with_multiple_responses()
    {
        $results = $this->geocoder->getAllCoordinatesForAddress('Washingtons');

        $this->assertIsArray($results);
        $this->assertIsArray($results[0]);

        $result = $results[0];

        $this->assertArrayHasKey('lat', $result);
        $this->assertArrayHasKey('lng', $result);
        $this->assertArrayHasKey('accuracy', $result);
        $this->assertArrayHasKey('formatted_address', $result);
        $this->assertArrayHasKey('viewport', $result);
    }

    /** @test */
    public function it_should_return_an_empty_response_when_called_with_empty_query()
    {
        $this->assertEquals($this->emptyResponse(), $this->geocoder->getCoordinatesForAddress(''));
    }

    /** @test */
    public function it_should_return_an_empty_response_when_using_a_non_existing_city()
    {
        $this->assertEquals($this->emptyResponse(), $this->geocoder->getCoordinatesForAddress('Spatieville'));
    }

    /** @test */
    public function it_can_translate_the_data()
    {
        $result = $this->geocoder->getCoordinatesForAddress('Roma, Italy');

        $this->assertEquals('Rome, Metropolitan City of Rome, Italy', $result['formatted_address']);

        $result = $this->geocoder
            ->setLanguage('it')
            ->getCoordinatesForAddress('Roma, Italy');

        $this->assertEquals('Roma RM, Italia', $result['formatted_address']);
    }

    /** @test */
    public function it_can_translate_coordinates_to_an_address()
    {
        $result = $this->geocoder->getAddressForCoordinates(40.714224, -73.961452);

        $this->assertEquals('279 Bedford Ave, Brooklyn, NY 11211, USA', $result['formatted_address']);

        $result = $this->geocoder
            ->setLanguage('nl')
            ->getAddressForCoordinates(40.714224, -73.961452);

        $this->assertEquals('279 Bedford Ave, Brooklyn, NY 11211, Verenigde Staten', $result['formatted_address']);
    }

    /** @test */
    public function it_can_include_the_address_components_in_a_response()
    {
        $results = $this->geocoder->getCoordinatesForAddress('Infinite Loop 1, Cupertino');

        $this->assertArrayHasKey('address_components', $results);
    }

    /** @test */
    public function it_includes_the_place_id_in_a_response()
    {
        $results = $this->geocoder->getCoordinatesForAddress('Infinite Loop 1, Cupertino');

        $this->assertArrayHasKey('place_id', $results);
    }

    /** @test */
    public function it_should_prefer_a_neighborhood_inside_of_payload_bounds()
    {
        $results = $this->geocoder
            ->setBounds('34.172684,-118.604794|34.236144,-118.500938')
            ->getCoordinatesForAddress('Winnetka');

        $this->assertEquals('Winnetka, Los Angeles, CA, USA', $results['formatted_address']);
    }

    protected function emptyResponse(): array
    {
        return [
            'lat' => 0,
            'lng' => 0,
            'accuracy' => Geocoder::RESULT_NOT_FOUND,
            'formatted_address' => Geocoder::RESULT_NOT_FOUND,
            'viewport' => Geocoder::RESULT_NOT_FOUND,
        ];
    }
}
