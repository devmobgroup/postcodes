<?php

namespace DevMob\Postcodes\Exceptions;

use Psr\Http\Message\ResponseInterface;
use Throwable;

class BadResponseException extends HttpException
{
    /**
     * Constructor.
     *
     * @param  string $message
     * @param  \Psr\Http\Message\ResponseInterface|null $response
     * @param  \Throwable|null $previous
     */
    public function __construct(string $message, ?ResponseInterface $response, ?Throwable $previous = null)
    {
        parent::__construct($message, null, $response, $previous);
    }
}
