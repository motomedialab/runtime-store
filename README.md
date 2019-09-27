# Runtime data store - simple runtime value caching

[![Latest Version on Packagist](https://img.shields.io/packagist/v/motomedialab/request-store.svg?style=flat-square)](https://packagist.org/packages/motomedialab/runtime-store)
[![Build Status](https://img.shields.io/travis/motomedialab/runtime-store/master.svg?style=flat-square)](https://travis-ci.org/motomedialab/runtime-store)
[![Total Downloads](https://img.shields.io/packagist/dt/motomedialab/runtime-store.svg?style=flat-square)](https://packagist.org/packages/motomedialab/runtime-store)

This is a simple package that allows caching of values for the duration of Laravel's runtime.
This is particularly useful in cases where scripts may be called multiple times and depend on
third parties or query calls to return data.

The package utilises a similar API to Laravel's `cache` and `session` helpers.

## Installation

You can install the package via composer:

```bash
composer require motomedialab/runtime-store
```

## Usage

Runtime store comes with a global helper `store()` function which we recommend using. These are demonstrated as defaults below.

``` php
// set a value
store()->set('key', 'value')
store()->put('key', 'value')
store()->add('key', 'value')

// check a value exists
store()->has('key')

// retrieve a value
store()->get('key'); // will return value
store()->get('key', 'default'); // has a default value

// remember a value once set
store()->remember('key', function () {

  // remember method will only execute the callback
  // once per runtime and return the stored value
  // on additional calls.

  return ['data' => 'value'];
});

// increment / decrement numerical values
store()->increment('key', 1)
store()->decrement('key', 1)

// forget a value after retrieving
store()->pull('key')

// forget a value/ multiple values
store()->forget('key')
store()->delete('key')
store()->forget(['key1', 'key2'])

// forget all values
store()->clear()
```

Additionally, you can call the runtime store via the app resolver - 

```php
app('store')->set('key', 'value');
resolve('store')->set('key', 'value');
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
