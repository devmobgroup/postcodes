<?php

namespace DevMob\Postcodes\Address;

use InvalidArgumentException;

class Address
{
    /**
     * Allowed postcode format.
     * Does not validate actual postcodes and is only used to normalise all postcodes used within this package.
     */
    public const POSTCODE_FORMAT = '/^(\d{4})([A-Z]{2})$/';

    /**
     * @var string
     */
    private $postcode;

    /**
     * @var string
     */
    private $houseNumber;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var array
     */
    private $raw;

    /**
     * Constructor.
     *
     * @param  string $postcode
     * @param  string $houseNumber
     * @param  string $street
     * @param  string $city
     * @param  string $province
     * @param  string $latitude
     * @param  string $longitude
     * @param  array $raw
     */
    public function __construct(
        string $postcode,
        string $houseNumber,
        string $street,
        string $city,
        string $province,
        string $latitude,
        string $longitude,
        array $raw = []
    ) {
        $this->setPostcode($postcode);
        $this->houseNumber = $houseNumber;
        $this->street = $street;
        $this->city = $city;
        $this->province = $province;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->raw = $raw;
    }

    /**
     * Postcode in '0000AA' format.
     *
     * @return string
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * Set postcode.
     *
     * @param  string $postcode
     * @return void
     */
    protected function setPostcode(string $postcode): void
    {
        if (! preg_match(self::POSTCODE_FORMAT, $postcode)) {
            throw new InvalidArgumentException('Postcode must match the expected format: ' . self::POSTCODE_FORMAT);
        }

        $this->postcode = $postcode;
    }

    /**
     * House number.
     *
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * Street name.
     *
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * City.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Province.
     *
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * Latitude.
     *
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * Longitude.
     *
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * Raw address data.
     *
     * @return array
     */
    public function getRaw(): array
    {
        return $this->raw;
    }
}
