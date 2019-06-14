# Geocode addresses to coordinates

[![Latest Version](https://img.shields.io/github/release/spatie/geocoder.svg?style=flat-square)](https://github.com/spatie/geocoder/releases)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/spatie/geocoder/master.svg?style=flat-square)](https://travis-ci.org/spatie/geocoder)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/c0e7c71d-351a-4996-9d74-24abfa074410.svg?style=flat-square)](https://insight.sensiolabs.com/projects/c0e7c71d-351a-4996-9d74-24abfa074410)
[![StyleCI](https://styleci.io/repos/19355432/shield)](https://styleci.io/repos/19355432)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/geocoder.svg?style=flat-square)](https://packagist.org/packages/spatie/geocoder)

This package can convert any address to GPS coordinates using [Google's geocoding service](https://developers.google.com/maps/documentation/geocoding/start). Here's a quick example:

```php
Geocoder::getCoordinatesForAddress('Samberstraat 69, Antwerpen, Belgium');

// will return this array
[
   'lat' => 51.2343564,
   'lng' => 4.4286108,
   'accuracy' => 'ROOFTOP',
   'formatted_address' => 'Samberstraat 69, 2060 Antwerpen, Belgium',
   'viewport' => [
       "northeast" => [
            "lat" => 51.23570538029149,
            "lng" => 4.429959780291502
        ],
        "southwest" => [
            "lat" => 51.2330074197085,
            "lng" => 4.427261819708497
        ]
   ]
]
```

## Installation

You can install this package through composer.

```bash
composer require spatie/geocoder
```
## Laravel installation

Thought the package works fine in non-Laravel projects we included some niceties for our fellow artistans.

In Laravel 5.5 the package will autoregister itself. In older versions of Laravel your must manually installed the service provider and facade.

```php
// config/app.php
'providers' => [
    '...',
    Spatie\Geocoder\GeocoderServiceProvider::class
];
```

```php
// config/app.php
'aliases' => array(
	...
	'Geocoder' => Spatie\Geocoder\Facades\Geocoder::class,
)
```

Next, you must publish the config file :

```bash
php artisan vendor:publish --provider="Spatie\Geocoder\GeocoderServiceProvider" --tag="config"
```

This is the content of the config file:

```php
return [

   /*
    * The api key used when sending Geocoding requests to Google.
    */
   'key' => env('GOOGLE_MAPS_GEOCODING_API_KEY', ''),


   /*
    * The language param used to set response translations for textual data.
    *
    * More info: https://developers.google.com/maps/faq#languagesupport
    */

   'language' => '',

   /*
    * The region param used to finetune the geocoding process.
    *
    * More info: https://developers.google.com/maps/documentation/geocoding/intro#RegionCodes
    */
   'region' => '',

    /*
     * The bounds param used to finetune the geocoding process.
     *
     * More info: https://developers.google.com/maps/documentation/geocoding/intro#Viewports
     */
    'bounds' => '',
    
     /*
     * The country param used to limit results to a specific country.
     *
     * More info: https://developers.google.com/maps/documentation/javascript/geocoding#GeocodingRequests
     */
    'country' => '',
];
```

## Usage

Here's how you can use the Geocoder.

```php
$client = new \GuzzleHttp\Client();

$geocoder = new Geocoder($client);

$geocoder->setApiKey(config('geocoder.key'));

$geocoder->setCountry(config('US');

$geocoder->getCoordinatesForAddress('Infinite Loop 1, Cupertino');

/*
  This function returns an array with keys
  "lat" =>  37.331741000000001
  "lng" => -122.0303329
  "accuracy" => "ROOFTOP"
  "formatted_address" => "1 Infinite Loop, Cupertino, CA 95014, USA",
  "viewport" => [
    "northeast" => [
      "lat" => 37.3330546802915,
      "lng" => -122.0294342197085
    ],
    "southwest" => [
      "lat" => 37.3303567197085,
      "lng" => -122.0321321802915
    ]
  ]
*/
```

You can get the result back in a specific language.

```php
$geocoder
   ->getCoordinatesForAddress('Infinite Loop 1, Cupertino')
   ->setLanguage('it');

/*
  This function returns an array with keys
  "lat" =>  37.331741000000001
  "lng" => -122.0303329
  "accuracy" => "ROOFTOP"
  "viewport" => [
    "northeast" => [
      "lat" => 37.3330546802915,
      "lng" => -122.0294342197085
    ],
    "southwest" => [
      "lat" => 37.3303567197085,
      "lng" => -122.0321321802915
    ]
  ]
*/
```

This is how you can reverse geocode coordinates to addresses.

```php
$geocoder->getAddressForCoordinates(40.714224, -73.961452);

/*
  This function returns an array with keys
  "lat" => 40.7142205
  "lng" => -73.9612903
  "accuracy" => "ROOFTOP"
  "formatted_address" => "277 Bedford Ave, Brooklyn, NY 11211, USA",
  "viewport" => [
    "northeast" => [
      "lat" => 37.3330546802915,
      "lng" => -122.0294342197085
    ],
    "southwest" => [
      "lat" => 37.3303567197085,
      "lng" => -122.0321321802915
    ]
  ]
*/
```


If you are using the package with Laravel, you can simply call `getCoordinatesForAddress`.

```php
Geocoder::getCoordinatesForAddress('Infinite Loop 1, Cupertino');

/*
  This function returns an array with keys
  "lat" =>  37.331741000000001
  "lng" => -122.0303329
  "accuracy" => "ROOFTOP"
  "formatted_address" => "1 Infinite Loop, Cupertino, CA 95014, Stati Uniti",
    "viewport" => [
    "northeast" => [
      "lat" => 37.3330546802915,
      "lng" => -122.0294342197085
    ],
    "southwest" => [
      "lat" => 37.3303567197085,
      "lng" => -122.0321321802915
    ]
  ]
*/
```

The accuracy key can contain these values:
- `ROOFTOP`
- `RANGE_INTERPOLATED`
- `GEOMETRIC_CENTER`
- `APPROXIMATE`

You can read more information about these values [on the Google Geocoding API Page](https://developers.google.com/maps/documentation/geocoding/ "Google Geocoding API")

When an address is not found accuracy and formatted_address will contain `NOT_FOUND`

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie).
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
