<?php

namespace DevMob\Postcodes\Exceptions;

use Exception;

/**
 * Indicates a combination of postcode and house number could not be found.
 */
class NoSuchCombinationException extends Exception implements PostcodesException
{
    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $number;

    /**
     * Constructor.
     *
     * @param  string $postcode
     * @param  string $number
     * @param  string $message
     */
    public function __construct(
        string $postcode,
        string $number,
        string $message = 'Combination of postcode and house number could not be found'
    ) {
        parent::__construct($message);

        $this->postcode = $postcode;
        $this->number = $number;
    }

    /**
     * Postcode provided to the {@see ProviderInterface::lookup()} function.
     *
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * House number provided to the {@see ProviderInterface::lookup()} function.
     *
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}
