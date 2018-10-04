<?php

namespace DevMob\Postcodes\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Generic exception type for errors that occur in a provider on runtime.
 */
abstract class ProviderException extends RuntimeException implements PostcodesException
{
    /**
     * Constructor.
     *
     * @param  string $message
     * @param  \Throwable|null $previous
     */
    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
