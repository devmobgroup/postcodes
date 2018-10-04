<?php

namespace DevMob\Postcodes\Util;

use DevMob\Postcodes\Exceptions\JsonException;
use Psr\Http\Message\ResponseInterface;

class Json
{
    /**
     * Json decode an http response.
     *
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @return array
     * @throws \DevMob\Postcodes\Exceptions\JsonException
     */
    public static function decode(ResponseInterface $response): array
    {
        $contents = $response->getBody()->getContents();
        $decoded = json_decode($contents, true);
        $response->getBody()->rewind();

        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
            throw new JsonException(json_last_error_msg());
        }

        return $decoded;
    }
}
