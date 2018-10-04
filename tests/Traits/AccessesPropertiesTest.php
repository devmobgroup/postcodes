<?php

namespace DevMob\Postcodes\Tests\Traits;

use Adbar\Dot;
use DevMob\Postcodes\Tests\TestCase;
use DevMob\Postcodes\Traits\AccessesProperties;

class AccessesPropertiesTest extends TestCase
{
    const DATA = ["one" => ["two" => "three"]];
    const KEY = 'one.two';

    public function test_accesses_properties_as_array()
    {
        // Arrange
        $proxy = new TraitProxy();

        // Act
        $value = $proxy->proxyGet(self::DATA, self::KEY);

        // Assert
        $this->assertEquals($value, 'three');
    }

    public function test_accesses_properties_as_dot_instance()
    {
        // Arrange
        $proxy = new TraitProxy();
        $dot = new Dot(self::DATA);

        // Act
        $value = $proxy->proxyGet($dot, self::KEY);

        // Assert
        $this->assertEquals($value, 'three');
    }
}

class TraitProxy
{
    use AccessesProperties;

    /**
     * @param  $data
     * @param  string $key
     * @return mixed
     */
    public function proxyGet($data, string $key)
    {
        return $this->get($data, $key);
    }
}
