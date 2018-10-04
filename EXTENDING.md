# Extending

This package only provides an abstraction layer for fetching postcode data. Actual sources must be added using providers.

You can find our own set of providers (for reference) [in this repository](https://github.com/devmobgroup/postcodes-providers).

## Create your own provider
All providers must implement the [`ProviderInterface`](https://github.com/devmobgroup/postcodes/src/Providers/ProviderInterface.php):
```php
/**
 * Lookup an address by postcode and house number.
 *
 * @param  string $postcode
 * @param  string $number
 * @return \DevMob\Postcodes\Address\Address[]
 * @throws \DevMob\Postcodes\Exceptions\NoSuchCombinationException
 * @throws \DevMob\Postcodes\Exceptions\PostcodesException
 */
public function lookup(string $postcode, string $number): array
{
    // TODO: implement
}
```

### Http providers
As a basis for http-powered providers we've created an [`HttpProvider`](https://github.com/devmobgroup/postcodes/src/Providers/ProviderInterface.php) 
class. Simply extend this class and implement the following methods:

```php
/**
 * Create http lookup request.
 *
 * @param  array $input
 * @return \Psr\Http\Message\RequestInterface
 */
protected function request(array $input): RequestInterface
{
    // TODO: implement
}

/**
 * Parse http lookup response.
 *
 * @param  \Psr\Http\Message\ResponseInterface $response
 * @param  array $input
 * @return \DevMob\Postcodes\Address\Address[]
 * @throws \DevMob\Postcodes\Exceptions\NoSuchCombinationException
 * @throws \DevMob\Postcodes\Exceptions\ProviderException
 */
protected function parse(ResponseInterface $response, array $input): array
{
    // TODO: implement
}
```

Requests will be handled by Guzzle (through [Guzzle's `ClientInterface`](https://github.com/guzzle/guzzle/blob/master/src/ClientInterface.php))
and follow the PSR7 standard for requests and responses.
