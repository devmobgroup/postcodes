<?php

namespace DevMob\Postcodes\Providers;

use DevMob\Postcodes\Exceptions\HttpException;
use DevMob\Postcodes\Exceptions\PostcodesException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use LogicException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

abstract class HttpProvider implements ProviderInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;

    /**
     * Set the Http client.
     *
     * @param  \GuzzleHttp\ClientInterface $client
     * @return void
     */
    public function setClient(ClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * Get the Http client.
     *
     * @return \GuzzleHttp\ClientInterface
     */
    public function getClient(): ClientInterface
    {
        if (! isset($this->client)) {
            $this->client = new GuzzleClient();
        }

        return $this->client;
    }


    /**
     * Lookup an address by postcode and house number.
     *
     * @param  string $postcode
     * @param  string $number
     * @return \DevMob\Postcodes\Address\Address[]
     * @throws \DevMob\Postcodes\Exceptions\NoSuchCombinationException
     * @throws \DevMob\Postcodes\Exceptions\PostcodesException
     */
    public function lookup(string $postcode, string $number): array
    {
        $input = [
            'postcode' => $postcode,
            'number' => $number
        ];

        // Create http request to send
        $request = $this->request($input);

        $response = null;
        try {
            // Make request and parse response
            return $this->parse(
                $response = $this->client->send($request),
                $input
            );
        } catch (GuzzleException $e) {
            // Catch request exceptions and try to parse the response
            if ($e instanceof RequestException && $e->hasResponse()) {
                return $this->parse($e->getResponse(), $input);
            }

            throw new HttpException('Guzzle: ' . $e->getMessage(), $request, $response, $e);
        } catch (Throwable $e) {
            // Only rethrow exceptions from our own package
            if ($e instanceof PostcodesException) {
                throw $e;
            }

            throw new LogicException('Uncaught exception: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Create http lookup request.
     *
     * @param  array $input
     * @return \Psr\Http\Message\RequestInterface
     */
    abstract protected function request(array $input): RequestInterface;

    /**
     * Parse http lookup response.
     *
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @param  array $input
     * @return \DevMob\Postcodes\Address\Address[]
     * @throws \DevMob\Postcodes\Exceptions\NoSuchCombinationException
     * @throws \DevMob\Postcodes\Exceptions\ProviderException
     */
    abstract protected function parse(ResponseInterface $response, array $input): array;
}
