<?php

namespace Spatie\Geocoder\Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Spatie\Geocoder\Geocoder;

class GeocoderTest extends TestCase
{
    /** @var \Spatie\Geocoder\Geocoder */
    protected $geocoder;

    public function setUp()
    {
        $client = new Client();

        $this->geocoder = new Geocoder($client);
    }

    /** @test */
    public function it_can_geocode_a_city()
    {
        $result = $this->geocoder->getCoordinatesForAddress('Antwerp');

        $this->assertArrayHasKey('lat', $result);
        $this->assertArrayHasKey('lng', $result);
        $this->assertArrayHasKey('accuracy', $result);
        $this->assertArrayHasKey('formatted_address', $result);
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
        $result = $this->geocoder->getCoordinatesForAddress('Roma');

        $this->assertEquals('Rome, Metropolitan City of Rome, Italy', $result['formatted_address']);

        $result = $this->geocoder
            ->setLanguage('it')
            ->getCoordinatesForAddress('Roma');

        $this->assertEquals('Roma RM, Italia', $result['formatted_address']);
    }

    protected function emptyResponse(): array
    {
        return [
            'lat' => 0,
            'lng' => 0,
            'accuracy' => Geocoder::RESULT_NOT_FOUND,
            'formatted_address' => Geocoder::RESULT_NOT_FOUND,
        ];
    }
}