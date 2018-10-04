<?php

namespace DevMob\Postcodes\Tests\Util;

use DevMob\Postcodes\Tests\TestCase;
use DevMob\Postcodes\Util\Uri;

class UriTest extends TestCase
{
    /**
     * @dataProvider uriDataProvider
     */
    public function test_create($parameters, $expected)
    {
        // Act
        $url = Uri::create($parameters['base'], $parameters['query']);

        // Assert
        $this->assertEquals($expected, $url);
    }

    public function uriDataProvider(): array
    {
        return [
            [
                [
                    'base' => 'https://www.example.com',
                    'query' => [
                        'hello' => 'world',
                    ],
                ],
                'https://www.example.com/?hello=world',
            ],
            [
                [
                    'base' => 'https://example.com',
                    'query' => [],
                ],
                'https://example.com',
            ],
        ];
    }
}
