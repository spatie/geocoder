# Geocode addresses to coordinates

[![Latest Version](https://img.shields.io/github/release/spatie/geocoder.svg?style=flat-square)](https://github.com/spatie/geocoder/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/geocoder/master.svg?style=flat-square)](https://travis-ci.org/spatie/geocoder)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/geocoder.svg?style=flat-square)](https://packagist.org/packages/spatie/geocoder)

Laravel package to convert any address to GPS coordinates.

Spatie is webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Installation

You can install this package through composer.

```json
{
    "require": {
		"spatie/geocoder": "^2.0"
	}
}
```

*Note: use ^1.0 for Laravel 4 support*

When using Laravel there is a service provider that you can make use of.

```php

// config/app.php

'providers' => [
    '...',
    'Spatie\Geocoder\GeocoderServiceProvider'
];
```

Geocoder also comes with a facade, which provides an easy way to call the Geocoder.


```php

// config/app.php

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

You can read more information about these values [on the Google Geocoding API Page](https://developers.google.com/maps/documentation/geocoding/ "Google Geocoding API")

When an address is not found accuracy will contain 'NOT_FOUND'

## About Spatie
Spatie is webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).
