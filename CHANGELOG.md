# Changelog

All notable changes to `geocoder` will be documented in this file.

## 3.16.1 - 2025-02-21

### What's Changed

* Laravel 12.x Compatibility by @laravel-shift in https://github.com/spatie/geocoder/pull/115

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.16.0...3.16.1

## 3.16.0 - 2024-03-02

### What's Changed

* Laravel 11.x Compatibility by @laravel-shift in https://github.com/spatie/geocoder/pull/113

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.15.0...3.16.0

## 3.15.0 - 2023-10-17

### What's Changed

- Return types by @francoism90 in https://github.com/spatie/geocoder/pull/112

### New Contributors

- @francoism90 made their first contribution in https://github.com/spatie/geocoder/pull/112

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.14.2...3.15.0

## 3.14.2 - 2023-02-01

### What's Changed

- Fixes the example for a specific language by @hofmannsven in https://github.com/spatie/geocoder/pull/107
- Add PHP 8.2 Support by @patinthehat in https://github.com/spatie/geocoder/pull/108
- Laravel 10.x Compatibility by @laravel-shift in https://github.com/spatie/geocoder/pull/110

### New Contributors

- @hofmannsven made their first contribution in https://github.com/spatie/geocoder/pull/107
- @patinthehat made their first contribution in https://github.com/spatie/geocoder/pull/108
- @laravel-shift made their first contribution in https://github.com/spatie/geocoder/pull/110

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.14.1...3.14.2

## 3.14.1 - 2022-06-29

- fix `partial_match` error

## 3.14.0 - 2022-06-28

### What's Changed

- Update formatResponse to include partial_match by @MultiSuperFreek in https://github.com/spatie/geocoder/pull/103

### New Contributors

- @MultiSuperFreek made their first contribution in https://github.com/spatie/geocoder/pull/103

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.13.1...3.14.0

## 3.13.1 - 2022-06-26

### What's Changed

- Update Geocoding API doc url by @newjett0617 in https://github.com/spatie/geocoder/pull/102

### New Contributors

- @newjett0617 made their first contribution in https://github.com/spatie/geocoder/pull/102

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.13.0...3.13.1

## 3.13.0 - 2022-05-18

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.12.0...3.13.0

## 3.12.0 - 2022-02-09

## What's Changed

- Support illuminate/support 9.0 by @austenc in https://github.com/spatie/geocoder/pull/99

## New Contributors

- @austenc made their first contribution in https://github.com/spatie/geocoder/pull/99

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.11.0...3.12.0

## 3.11.0 - 2021-11-18

- Add support for PHP 8.1

**Full Changelog**: https://github.com/spatie/geocoder/compare/3.10.1...3.11.0

## 3.10.1 - 2020-12-02

- revert previous version

## 3.10.0 - 2020-12-01

- add `plus_code` to formatted response (#91)

## 3.9.3 - 2020-12-01

- Add support for PHP 8.0 ([#90](https://github.com/spatie/geocoder/pull/90))

## 3.9.2 - 2020-09-09

- Add support for Laravel 8

## 3.9.1 - 2020-08-06

- add ability to resolve Geocoder from the fully qualified class name (#87)

## 3.9.0 - 2020-07-27

- return multiple results for reverse-geocoding (#86)

## 3.8.1 - 2020-07-01

- allow Guzzle 7

## 3.8.0 - 2020-05-11

- return multiple results as array rather than just the first one (#73)

## 3.7.0 - 2020-03-04

- add support for Laravel 7

## 3.6.1 - 2019-01-04

- improve testability by resolving the guzzle client out of the container

## 3.6.0 - 2019-09-04

- add support for Laravel 6

## 3.5.0 - 2019-05-31

- add country parameter
- drop support for PHP 7.1 and smaller

## 3.4.0 - 2018-01-24

- include address components in the response

## 3.3.1 - 2018-05-15

- fix PHP 7.0 requirement in composer.json

## 3.3.0 - 2018-04-20

- add support for setting bounds

## 3.2.0 - 2018-03-30

- add viewport coordinates to `Geocoder::formatResponse()`

## 3.1.1 - 2018-02-21

- improved exception handling

## 3.1.0 - 2017-10-25

- add `getAddressForCoordinates`

## 3.0.1 - 2017-10-24

- fix typo

## 3.0.0 - 2017-10-24

- dropped support for PHP 5
- cleaned up internals
- some small API changes

## 2.3.2 - 2016-11-15

- require Guzzle 6 instead of 5

## 2.3.1 - 2016-09-04

- fixed the naming of variables in the `Geocoder` interface

### 2.3.0 - 2016-09-01

- added support for regions and languages
- added Laravel integration

### 2.2.0 - 2016-08-20

- add `formatted_address` to result

### 2.1.3 - 2016-08-07

- remove `sensor` parameter

### 2.1.2 - 2016-07-04

- upgrade Guzzle version

### 2.1.1 - 2016-03-10

- use HTTPS to connect to google
