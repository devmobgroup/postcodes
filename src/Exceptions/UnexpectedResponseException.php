<?php

namespace DevMob\Postcodes\Exceptions;

class UnexpectedResponseException extends ProviderException
{
    /**
     * Constructor.
     *
     * @param  string $message
     */
    public function __construct(string $message = 'Response was not as expected')
    {
        parent::__construct($message);
    }
}
