
# Runtime data store - simple runtime value caching  
  
[![Latest Version on Packagist](https://img.shields.io/packagist/v/motomedialab/runtime-store.svg?style=flat-square)](https://packagist.org/packages/motomedialab/runtime-store)  
[![StyleCI Code Quality](https://github.styleci.io/repos/211288585/shield?style=flat-square)](https://github.styleci.io/repos/211288585)  
[![Build Status](https://img.shields.io/travis/motomedialab/runtime-store/master.svg?style=flat-square)](https://travis-ci.org/motomedialab/runtime-store)  
[![Total Downloads](https://img.shields.io/packagist/dt/motomedialab/runtime-store.svg?style=flat-square)](https://packagist.org/packages/motomedialab/runtime-store)  
  
A simple framework-agnostic package (that plays particularly nicely with Laravel's app container, [see here](#accessing-the-store)) that allows caching of values for the duration of a requests lifetime.
  
This is particularly useful in cases where scripts may be called on multiple times and depend on  
third parties or query calls to return data.  
  
## Installation  
  
You can install the package via composer:  
  
```bash  
composer require motomedialab/runtime-store  
```  
  
## Usage  
  
Runtime store comes with a global helper `store()` which uses the singleton pattern and we recommend using.  
However, there are multiple ways of accessing the Runtime Store as its framework agnostic, [see here](#accessing-the-store).
  
The package utilises a similar API to Laravel's `cache` and `session` helpers, as demonstrated below.
  
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

### Grouping

As of v1.2, you can create groups. Groups have the exact same API as above, with a few extras methods to easily create and delete groups.

```php
// creating a group and setting your first value...
store()->group('groupName')->set('key', 'value')

// getting a key from a group
store()->group('groupName')->get('key')

// checking if a group exists
store()->hasGroup('groupName')

// deleting a group
store()->deleteGroup('groupName')
```
---
  
### Accessing the store

There are many ways to access the store and you can write your own implementation quickly and easily.
  
```php  
// in Laravel, there are multiple ways to resolve a global instance of the store...  
app(\Motomedialab\RuntimeStore\RuntimeStore::class)->get('value');
\Motomedialab\RuntimeStore\RuntimeStoreFacade::get('value');
app('store')->get('value');  
resolve('store')->get('value');  

// there is a global store() helper method, demonstrated below.
// this also integrates with Laravel's application layer directly (when installed).
store()->get('value');
```  

#### Accessing from within a class

We've built a handy trait which you can use in your classes to instantly boot up a grouped store, scoped to that class name. In the example below, any values will be set within a group called `YourClass` automatically.

```php
class YourClass {
  use \Motomedialab\RuntimeStore\Traits\HasRuntimeStore;

  public function yourMethod()
  {
    return $this->store()->remember('key', function () {
      return 'This value will be remembered as long as the request is active!';
    });
  }
}
```

#### Further implementations

We've covered off pretty much everything above but if you're looking to implement the RuntimeStore in your own way, here's a couple of examples...

```php
// procedual example
$store = null;  
function store() {  
    global $store;  
    
    if ($store) {
      return $store;
    }
    
    return $store = new \Motomedialab\RuntimeStore\RuntimeStore;  
}
```

```php
// OOP example
class ClassWithStore {
  protected $store;

  public function store() {
    if ($this->store) {
      return $this->store;
    }
    
    return $this->store = new \MotoMediaLab\RuntimeStore\RuntimeStore;
  }
}
```

---
  
### Testing  

We've carried out extensive testing to make sure everything works as expected, but feel free to try it yourself!
  
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
