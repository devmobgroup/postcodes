<?php

namespace DevMob\Postcodes\Exceptions;

use Psr\Http\Message\RequestInterface;
use Throwable;

class BadRequestException extends HttpException
{
    /**
     * Constructor.
     *
     * @param  string $message
     * @param  \Psr\Http\Message\RequestInterface|null $request
     * @param  \Throwable|null $previous
     */
    public function __construct(string $message, ?RequestInterface $request = null, ?Throwable $previous = null)
    {
        parent::__construct($message, $request, null, $previous);
    }
}
