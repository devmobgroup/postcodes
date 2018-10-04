<?php

namespace DevMob\Postcodes\Traits;

use Adbar\Dot;
use DevMob\Postcodes\Exceptions\UnexpectedResponseException;

trait AccessesProperties
{
    /**
     * Extract data from an array using dot notation.
     * Throws an exception when the provided key does not exist.
     *
     * @param  array|\Adbar\Dot $data
     * @param  string $key Supports dot notation {@see https://github.com/adbario/php-dot-notation}
     * @return mixed
     * @throws \DevMob\Postcodes\Exceptions\UnexpectedResponseException
     */
    protected function get($data, string $key)
    {
        $dot = $data instanceof Dot ? $data : new Dot($data);

        if (isset($dot[$key])) {
            return $dot[$key];
        }

        throw new UnexpectedResponseException(sprintf('Missing key \'%s\' in data'));
    }
}
