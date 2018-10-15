<?php

namespace DevMob\Postcodes;

use DevMob\Postcodes\Cache\NullCache;
use DevMob\Postcodes\Providers\ProviderInterface;
use Psr\SimpleCache\CacheInterface;

class Postcodes implements ProviderInterface
{
    /**
     * @var \DevMob\Postcodes\Providers\ProviderInterface
     */
    private $provider;

    /**
     * @var \Psr\SimpleCache\CacheInterface
     */
    private $cache;

    /**
     * Constructor.
     *
     * @param  \DevMob\Postcodes\Providers\ProviderInterface $provider
     * @param  \Psr\SimpleCache\CacheInterface|null $cache
     */
    public function __construct(ProviderInterface $provider, ?CacheInterface $cache = null)
    {
        $this->provider = $provider;
        $this->cache = $cache ?: new NullCache();
    }

    /**
     * Lookup an address by postcode and house number.
     *
     * @param  string $postcode
     * @param  string $number
     * @return \DevMob\Postcodes\Address\Address[]
     * @throws \DevMob\Postcodes\Exceptions\NoSuchCombinationException
     * @throws \DevMob\Postcodes\Exceptions\PostcodesException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function lookup(string $postcode, string $number): array
    {
        $key = sprintf('%s-%s', $postcode, $number);
        $result = $this->cache->get($key);

        if ($result === null) {
            $result = $this->provider->lookup($postcode, $number);
            $this->cache->set($key, $result);
        }

        return $result;
    }
}
