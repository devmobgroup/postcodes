<?php

namespace DevMob\Postcodes\Tests\Cache;

use DevMob\Postcodes\Cache\NullCache;
use DevMob\Postcodes\Tests\TestCase;

class NullCacheTest extends TestCase
{
    /**
     * @dataProvider nullCacheDataProvider
     */
    public function test_get_multiple($parameters, $expected)
    {
        // Arrange
        $nullCache = new NullCache();
        $default = $parameters['default'] ?? null;

        // Act
        $result = $nullCache->getMultiple($parameters['keys'], $default);

        // Assert
        $this->assertEquals($expected, $result);
    }

    public function nullCacheDataProvider(): array
    {
        return [
            [
                [
                    'keys' => [],
                ],
                [],
            ],
            [
                [
                    'keys' => ['a'],
                ],
                [
                    'a' => null,
                ],
            ],
            [
                [
                    'keys' => ['a', 'b', 'c'],
                ],
                [
                    'a' => null,
                    'b' => null,
                    'c' => null,
                ],
            ],
            [
                [
                    'keys' => ['a', 'b', 'c'],
                    'default' => 'default_value',
                ],
                [
                    'a' => 'default_value',
                    'b' => 'default_value',
                    'c' => 'default_value',
                ],
            ],
        ];
    }
}
