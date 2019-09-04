# Changelog

All notable changes to `geocoder` will be documented in this file.

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

- use https to connect to google
