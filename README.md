# Geocode addresses to coordinates

[![Latest Version](https://img.shields.io/github/release/spatie/geocoder.svg?style=flat-square)](https://github.com/spatie/geocoder/releases)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/spatie/geocoder/run-tests?label=tests)
![Check & fix styling](https://github.com/spatie/geocoder/workflows/Check%20&%20fix%20styling/badge.svg)
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

## Support us

Learn how to create a package like this one, by watching our premium video course:

[![Laravel Package training](https://spatie.be/github/package-training.jpg)](https://laravelpackage.training)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install this package through composer.

```bash
composer require spatie/geocoder
```
## Laravel installation

Though the package works fine in non-Laravel projects we included some niceties for our fellow artistans.

In Laravel 5.5 the package will autoregister itself. In older versions of Laravel you must manually install the service provider and facade.

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

$geocoder->setCountry(config('geocoder.country', 'US'));

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

You can also get all the results instead of the first one
```php
$geocoder
   ->getAllCoordinatesForAddress('Infinite Loop 1, Cupertino');

/*
  This function returns an array of results (array of array)
  ^ array:2 [
      0 => array:7 [
        "lat" => 37,3318115
        "lng" => -122,0301837
        "accuracy" => "ROOFTOP"
        "formatted_address" => "1 Infinite Loop, Cupertino, CA 95014, Stati Uniti"
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
        "place_id" => "ChIJHTRqF7e1j4ARzZ_Fv8VA4Eo"
      ]
      1 => array:7 [
        "lat" => 37,3318598
        "lng" => -122,0302485
        "accuracy" => "ROOFTOP"
        "formatted_address" => "Infinite Loop 1, 1 Infinite Loop, Cupertino, CA 95014, Stati Uniti"
        "viewport" => [
          "northeast" => [
            "lat" => 37.333046180291
            "lng" => -122.02883961971
          ],
          "southwest" => [
            "lat" => 37.330348219708
            "lng" => -122.03153758029
          ]
        ]
        "place_id" => "ChIJAf9D3La1j4ARuwKZtGjgMXw"
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

You can also reverse geocode coordinates to all the related addresses.

```php
$geocoder->getAllAddressesForCoordinates(40.714224, -73.961452);

/*
  This function returns an array of results (array of array)
  array:2 [
    0 => array: 7 [
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
    ],
    1 => array: 7 [
      "lat" => 40.7142015
      "lng" => -73.9613077
      "accuracy" => "ROOFTOP"
      "formatted_address" => "279 Bedford Ave, Brooklyn, NY 11211, USA",
      "viewport" => [
        "northeast" => [
          "lat" => 40.715557080291,
          "lng" => -73.959947169708
        ],
        "southwest" => [
          "lat" => 40.712859119708,
          "lng" => -73.962645130291
        ]
      ]
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

When an address is not found accuracy and formatted_address will contain `result_not_found`

## Credits

- [Freek Van der Herten](https://github.com/freekmurze)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
