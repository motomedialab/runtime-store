# Runtime data store - simple runtime value caching

[![Latest Version on Packagist](https://img.shields.io/packagist/v/motomedialab/request-store.svg?style=flat-square)](https://packagist.org/packages/motomedialab/runtime-store)
[![Build Status](https://img.shields.io/travis/motomedialab/runtime-store/master.svg?style=flat-square)](https://travis-ci.org/motomedialab/runtime-store)
[![Quality Score](https://img.shields.io/scrutinizer/g/motomedialab/runtime-store.svg?style=flat-square)](https://scrutinizer-ci.com/g/motomedialab/runtime-store)
[![Total Downloads](https://img.shields.io/packagist/dt/motomedialab/runtime-store.svg?style=flat-square)](https://packagist.org/packages/motomedialab/runtime-store)

This is a simple package that allows caching of values for the duration of Laravel's runtime.
This is particularly useful in cases where scripts may be called multiple times and depend on
third parties or query calls to return data.

## Installation

You can install the package via composer:

```bash
composer require motomedialab/runtime-store
```

## Usage

``` php
// set a value
store()->set('key', 'value')

// retrieve a value
store()->get('key'); // will return value

// retrieve a value with a custom default
store()->get('key', 'default');
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email hello@motomedialab.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com), a super handy
package templating application.
