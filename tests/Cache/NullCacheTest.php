<?php

namespace DevMob\Postcodes\Tests\Cache;

use DevMob\Postcodes\Cache\NullCache;
use DevMob\Postcodes\Tests\TestCase;

class NullCacheTest extends TestCase
{
    /**
     * Test get method.
     *
     * @return void
     */
    public function test_get(): void
    {
        // Arrange
        $nullCache = new NullCache();

        // Assert
        $this->assertEquals(null, $nullCache->get('key_1'));
        $this->assertEquals(null, $nullCache->get('key_2'));
        $this->assertFalse($nullCache->get('key_1', false));
        $this->assertFalse($nullCache->get('key_2', false));
    }

    /**
     * Test set method.
     *
     * @return void
     */
    public function test_set(): void
    {
        // Arrange
        $nullCache = new NullCache();

        // Assert
        $this->assertTrue($nullCache->set('key_1', 'value'));
        $this->assertTrue($nullCache->set('key_2', 'value'));
        $this->assertTrue($nullCache->set('key_1', 'value', 60));
        $this->assertTrue($nullCache->set('key_2', 'value', 60));
    }

    /**
     * Test delete method.
     *
     * @return void
     */
    public function test_delete(): void
    {
        // Arrange
        $nullCache = new NullCache();

        // Assert
        $this->assertTrue($nullCache->delete('key_1'));
        $this->assertTrue($nullCache->delete('key_2'));
    }

    /**
     * Test clear method.
     *
     * @return void
     */
    public function test_clear(): void
    {
        // Arrange
        $nullCache = new NullCache();

        // Assert
        $this->assertTrue($nullCache->clear());
    }

    /**
     * Test getMultiple method.
     *
     * @dataProvider getMultipleDataProvider
     * @param  array $parameters
     * @param  $expected
     * @return void
     */
    public function test_get_multiple(array $parameters, $expected): void
    {
        // Arrange
        $nullCache = new NullCache();
        $default = $parameters['default'] ?? null;

        // Assert
        $this->assertEquals($expected, $nullCache->getMultiple($parameters['keys'], $default));
    }

    /**
     * Test setMultiple method.
     *
     * @return void
     */
    public function test_set_multiple(): void
    {
        // Arrange
        $nullCache = new NullCache();

        // Assert
        $this->assertTrue($nullCache->setMultiple(['key_1' => 'value']));
        $this->assertTrue($nullCache->setMultiple(['key_2' => 'value']));
        $this->assertTrue($nullCache->setMultiple(['key_1' => 'value'], 60));
        $this->assertTrue($nullCache->setMultiple(['key_2' => 'value'], 60));
    }

    /**
     * Test deleteMultiple method.
     *
     * @return void
     */
    public function test_delete_multiple(): void
    {
        // Arrange
        $nullCache = new NullCache();

        // Assert
        $this->assertTrue($nullCache->deleteMultiple(['key_1']));
        $this->assertTrue($nullCache->deleteMultiple(['key_1', 'key_2']));
    }

    /**
     * Test has method.
     *
     * @return void
     */
    public function test_has(): void
    {
        // Arrange
        $nullCache = new NullCache();

        // Assert
        $this->assertFalse($nullCache->has('key_1'));
        $this->assertFalse($nullCache->has('key_2'));
    }

    /**
     * Data for getMultiple.
     *
     * @return array
     */
    public function getMultipleDataProvider(): array
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
                    'keys' => ['key_1'],
                ],
                [
                    'key_1' => null,
                ],
            ],
            [
                [
                    'keys' => ['key_1', 'key_2', 'key_3'],
                ],
                [
                    'key_1' => null,
                    'key_2' => null,
                    'key_3' => null,
                ],
            ],
            [
                [
                    'keys' => ['key_1', 'key_2', 'key_3'],
                    'default' => false,
                ],
                [
                    'key_1' => false,
                    'key_2' => false,
                    'key_3' => false,
                ],
            ],
        ];
    }
}
