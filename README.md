# Geocode addresses to coordinates

[![Latest Version](https://img.shields.io/github/release/spatie/geocoder.svg?style=flat-square)](https://github.com/spatie/geocoder/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/geocoder/master.svg?style=flat-square)](https://travis-ci.org/spatie/geocoder)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/c0e7c71d-351a-4996-9d74-24abfa074410.svg?style=flat-square)](https://insight.sensiolabs.com/projects/c0e7c71d-351a-4996-9d74-24abfa074410)
[![StyleCI](https://styleci.io/repos/19355432/shield)](https://styleci.io/repos/19355432)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/geocoder.svg?style=flat-square)](https://packagist.org/packages/spatie/geocoder)

This PHP package can convert any address to GPS coordinates.

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
# Laravel installation

If you are using this package with Laravel, you must:

Install this service provider

```php
// config/app.php
'providers' => [
    '...',
    'Spatie\Geocoder\GeocoderServiceProvider'
];
```

Geocoder also comes with a facade, which provides an easy way to call the Geocoder, so you have to register it


```php
// config/app.php
'aliases' => array(
	...
	'Geocoder' => 'Spatie\Geocoder\GeocoderFacade',
)
```

Next, you must publish the config file (geocoder.php):

```bash
php artisan vendor:publish --provider="Spatie\Geocoder\GeocoderServiceProvider" --tag="config"
```
You must set the API key into the config file because it is required by Google API.

## Usage

The "getCoordinatesForQuery" accepts 4 parameter:
1) the query (required)
2) the API KEY (required in framework agnostic installation)
3) the language (optional)
4) the region (optional)

You can call the getCoordinatesForQuery after instantiate Geocoder class.

```php

$geocoder = new Geocoder;
$geocoder->getCoordinatesForQuery('Infinite Loop 1, Cupertino', <YOUR-API-KEY>, null, null);

/* 
  This function returns an array with keys
  "lat" =>  37.331741000000001
  "lng" => -122.0303329
  "accuracy" => "ROOFTOP"
  "formatted_address" => "1 Infinite Loop, Cupertino, CA 95014, USA"
*/
```

The language and region parameters are very useful in order to obtain the "formatted_address" string (into the response), translated into the proper language (English is default), for example:

```php

$geocoder = new Geocoder;
$geocoder->getCoordinatesForQuery('Infinite Loop 1, Cupertino', 'it', 'it', <YOUR-API-KEY>);

/* 
  This function returns an array with keys
  "lat" =>  37.331741000000001
  "lng" => -122.0303329
  "accuracy" => "ROOFTOP"
  "formatted_address" => "1 Infinite Loop, Cupertino, CA 95014, Stati Uniti"
*/
```

If you are using the package with Laravel, you can simply call the getCoordinatesForQuery method on the facade, passing only the query parameter (after filled the config file parameters):

```php

Geocoder::getCoordinatesForQuery('Infinite Loop 1, Cupertino');

/* 
  This function returns an array with keys
  "lat" =>  37.331741000000001
  "lng" => -122.0303329
  "accuracy" => "ROOFTOP"
  "formatted_address" => "1 Infinite Loop, Cupertino, CA 95014, Stati Uniti"
*/
```

The accuracy key can contain these values:
- `ROOFTOP`
- `RANGE_INTERPOLATED`
- `GEOMETRIC_CENTER`
- `APPROXIMATE`

You can read more information about these values [on the Google Geocoding API Page](https://developers.google.com/maps/documentation/geocoding/ "Google Geocoding API")

When an address is not found accuracy and formatted_address will contain `NOT_FOUND`

## About Spatie
Spatie is a webdesign agency in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).
