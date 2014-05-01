# Geocode addresses to coordinates

[![Build Status](https://travis-ci.org/freekmurze/geocoder.svg?branch=master)](https://travis-ci.org/freekmurze/geocoder)

The package can convert any address to GPS coordinates.

## Installation

You can install this package through Composer.

```js
{
    "require": {
		"spatie/geocoder": "dev-master"
	}
}
```

When using Laravel there is a service provider that you can make use of.

```php

// app/config/app.php

'providers' => [
    '...',
    'Spatie\GeocoderServiceProvider'
];
```

Geocoder also comes with a facade, which provides an easy way to call the Geocoder.


```php

// app/config/app.php

'aliases' => array(
	...
	'Geocoder' => 'Spatie\Geocoder\GeocoderFacade',
)
```

## Usage

```php

Geocoder::getCoordinatesForQuery('Infinite Loop 1, Cupertino');

/* 
  This function returns an array with keys
  "lat" =>  37.331741000000001
  "lng" => -122.0303329
  "accuracy" => "ROOFTOP"
*/
```

The accuracy key can contain these values:
- 'ROOFTOP'
- 'RANGE_INTERPOLATED'
- 'GEOMETRIC_CENTER'
- 'APPROXIMATE'

You can read lore information about these values [on the Google Geocoding API Page](https://developers.google.com/maps/documentation/geocoding/ "Google Geocoding API")

When an address is not found accuracy will contain 'NOT_FOUND'
