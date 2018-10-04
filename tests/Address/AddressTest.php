<?php

namespace DevMob\Postcodes\Tests\Address;

use DevMob\Postcodes\Address\Address;
use DevMob\Postcodes\Tests\TestCase;
use InvalidArgumentException;

class AddressTest extends TestCase
{
    public function test_getters()
    {
        // Arrange
        $postcode = '2990ED';
        $houseNumber = '50';
        $street = 'Schiedamsedijk';
        $city = 'Rotterdam';
        $provice = 'Zuid-Holland';
        $latitude = '51.9165218044479';
        $longitude = '4.4815251183740';
        $raw = ['year' => 1900];

        $address = new Address(
            $postcode,
            $houseNumber,
            $street,
            $city,
            $provice,
            $latitude,
            $longitude,
            $raw
        );

        // Assert
        $this->assertEquals($postcode, $address->getPostcode());
        $this->assertEquals($houseNumber, $address->getHouseNumber());
        $this->assertEquals($street, $address->getStreet());
        $this->assertEquals($city, $address->getCity());
        $this->assertEquals($provice, $address->getProvince());
        $this->assertEquals($latitude, $address->getLatitude());
        $this->assertEquals($longitude, $address->getLongitude());
        $this->assertEquals($raw, $address->getRaw());
    }

    public function test_postcode_in_constructor_given_invalid_format_throws_InvalidArgumentException()
    {
        // Expect
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Postcode must match the expected format: ' . Address::POSTCODE_FORMAT);

        // Act
        new Address(
            '3011 ED',
            '50',
            'Schiedamsedijk',
            'Rotterdam',
            'Zuid-Holland',
            '51.9165218044479',
            '4.4815251183740'
        );
    }
}
