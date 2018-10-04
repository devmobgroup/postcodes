<?php

namespace DevMob\Postcodes\Providers;

interface ProviderInterface
{
    /**
     * Lookup an address by postcode and house number.
     *
     * @param  string $postcode
     * @param  string $number
     * @return \DevMob\Postcodes\Address\Address[]
     * @throws \DevMob\Postcodes\Exceptions\NoSuchCombinationException
     * @throws \DevMob\Postcodes\Exceptions\PostcodesException
     */
    public function lookup(string $postcode, string $number): array;
}
