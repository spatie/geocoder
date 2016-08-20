# Geocode addresses to coordinates

[![Latest Version](https://img.shields.io/github/release/spatie/geocoder.svg?style=flat-square)](https://github.com/spatie/geocoder/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/geocoder/master.svg?style=flat-square)](https://travis-ci.org/spatie/geocoder)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/c0e7c71d-351a-4996-9d74-24abfa074410.svg?style=flat-square)](https://insight.sensiolabs.com/projects/c0e7c71d-351a-4996-9d74-24abfa074410)
[![StyleCI](https://styleci.io/repos/19355432/shield)](https://styleci.io/repos/19355432)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/geocoder.svg?style=flat-square)](https://packagist.org/packages/spatie/geocoder)

Laravel package to convert any address to GPS coordinates.

Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

## Postcardware

You're free to use this package (it's [MIT-licensed](LICENSE.md)), but if it makes it to your production environment you are required to send us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

The best postcards will get published on the open source page on our website.

## Installation

You can install this package through composer.

```bash
composer require spatie/geocoder
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
  "formatted_address" => "2 Infinite Loop, Cupertino, CA 95014, Stati Uniti"
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
Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).
