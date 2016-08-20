<?php

namespace spec\Spatie\Geocoder\Google;

use GuzzleHttp\Client;
use PhpSpec\ObjectBehavior;
use Spatie\Geocoder\Geocoder;

class GeocoderSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(new Client());
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Spatie\Geocoder\Google\Geocoder');
    }

    public function it_should_return_false_when_called_with_empty_query()
    {
        $this->object->getCoordinatesForQuery('')->shouldReturn(false);
    }

    public function it_should_return_coordinates_when_called()
    {
        $callResult = $this->object->getCoordinatesForQuery('Antwerp');
        $callResult->shouldBeArray();
        $callResult->shouldHaveKey('formatted_address');
        $callResult->shouldHaveKey('lat');
        $callResult->shouldHaveKey('lng');
        $callResult->shouldHaveKey('accuracy');
    }

    public function it_should_return_not_found_when_called_with_an_unknown_location()
    {
        $callResult = $this->object->getCoordinatesForQuery('gibberishlocation');
        $callResult->shouldBeArray();
        $callResult['formatted_address']->shouldBe(Geocoder::RESULT_NOT_FOUND);
        $callResult['accuracy']->shouldBe(Geocoder::RESULT_NOT_FOUND);
    }
}
