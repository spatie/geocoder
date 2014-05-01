<?php

namespace spec\Spatie\Geocoder\Google;

use Guzzle\Service\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Spatie\Geocoder\Geocoder;

class GeocoderSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(new Client());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Spatie\Geocoder\Google\Geocoder');
    }

    function it_called_with_empty_query_it_should_return_false()
    {
        $this->object->getCoordinatesForQuery('')->shouldReturn(false);
    }

    function it_should_return_coordinates_when_called()
    {
        $callResult = $this->object->getCoordinatesForQuery('Antwerp');
        $callResult->shouldBeArray();
        $callResult->shouldHaveKey('lat');
        $callResult->shouldHaveKey('lng');
        $callResult->shouldHaveKey('accuracy');
    }

    function it_should_return_not_found_when_called_with_an_unknown_location()
    {
        $callResult = $this->object->getCoordinatesForQuery('gibberishlocation');
        $callResult->shouldBeArray();
        $callResult['accuracy']->shouldBe(Geocoder::RESULT_NOT_FOUND);
    }
}
