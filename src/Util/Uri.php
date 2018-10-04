<?php

namespace DevMob\Postcodes\Util;

class Uri
{
    /**
     * Create request url based on base uri and request parameters.
     *
     * @param  string $baseUri
     * @param  array $query
     * @return string
     */
    public static function create(string $baseUri, array $query = []): string
    {
        if (count($query) === 0) {
            return $baseUri;
        }

        return sprintf('%s/?%s', $baseUri, http_build_query($query));
    }
}
