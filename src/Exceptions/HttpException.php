<?php

namespace DevMob\Postcodes\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class HttpException extends ProviderException
{
    /**
     * @var \Psr\Http\Message\RequestInterface|null
     */
    private $request;

    /**
     * @var \Psr\Http\Message\ResponseInterface|null
     */
    private $response;

    /**
     * Constructor.
     *
     * @param  string $message
     * @param  \Psr\Http\Message\RequestInterface|null $request
     * @param  \Psr\Http\Message\ResponseInterface|null $response
     * @param  \Throwable|null $previous
     */
    public function __construct(
        string $message = '',
        ?RequestInterface $request = null,
        ?ResponseInterface $response = null,
        Throwable $previous = null
    ) {
        parent::__construct($message, $previous);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Http request.
     *
     * @return \Psr\Http\Message\RequestInterface|null
     */
    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * Http response.
     *
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
