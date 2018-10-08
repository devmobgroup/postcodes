# Postcodes package

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://github.styleci.io/repos/149756327/shield)](https://github.styleci.io/repos/149756327)

This package provides some basic functionality that can be implemented for specific postcode APIs. This package alone
**does not** provide immediate access to postcode data. 

## Install
1. Install the base package:
    ```
    composer require devmobgroup/postcodes
    ```

2. Choose a postcode provider or [create your own](https://github.com/devmobgroup/postcodes/blob/master/EXTENDING.md).
You can find all of our own provider implementations [in this repository](https://github.com/devmobgroup/postcodes-providers).
    
    - **PostcodeAPI.nu** (recommended)
        [postcodeapi.nu](https:///postcodeapi.nu)
        ```
        composer require devmobgroup/postcodes-postcode-api-nu
        ```
        
    - **API Postcode**
        [api-postcode.nl](https://api-postcode.nl)
        ```
        composer require devmobgroup/postcodes-api-postcode
        ```
        
    Read more about [using and configuring these providers](https://github.com/devmobgroup/postcodes-providers#postcodes-providers).
      
## Usage
All providers implement the [`ProviderInterface`](https://github.com/devmobgroup/postcodes/blob/master/src/Providers/ProviderInterface.php)
which has a lookup method:
```php
$provider->lookup(string $postcode, string $number);
```

This method returns an **array** of [`Address`](https://github.com/devmobgroup/postcodes/blob/master/src/Address/Address.php) 
instances. This array should never be empty, because instead the `NoSuchCombinationException` exception indicates no 
results were found.
```php
$address = $addresses[0];

$address->getPostcode(); // '3011 ED'
$address->getHouseNumber(); // '50'
$address->getStreet(); // 'Schiedamsedijk'
$address->getCity(); // 'Rotterdam' 
$address->getProvince(); // 'Zuid-Holland'
$address->getLatitude(); // '51.9147442'
$address->getLongitude(); // '4.4766394'
```

There's also a `getRaw()` method which usually contains an array of the raw data retrieved from the provider:
```php
$address->getRaw(); // ['city' => 'Rotterdam', 'year' => 1990, ...]
``` 

Additionally, the `lookup()` method throws exceptions that should be caught.
```php
use DevMob\Postcodes\Exceptions\NoSuchCombinationException;
use DevMob\Postcodes\Exceptions\PostcodesException;

try {
    $provider->lookup('3011ED', '50');
} catch (NoSuchCombinationException $e) {
    // Combination of postcode and house number not found
} catch (PostcodesException $e) {
    // Catch-all interface for other exceptions.
    // It's best to always catch these exceptions, because
    // providers may implement their own exceptions that
    // are not documented in the ProviderInterface.
}
```

## Extending
[Read more about creating your own provider](https://github.com/devmobgroup/postcodes/blob/master/EXTENDING.md).

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
