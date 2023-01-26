<?php

namespace App\Client;

use Psr\Http\Client\ClientInterface as PsrClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class CurlClient implements ClientInterface, PsrClientInterface
{
    public function __construct(
        readonly private ResponseFactoryInterface $responseFactory,
        readonly private RequestFactoryInterface $requestFactory
        )
    {
    }

    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->responseFactory->createResponse(200, 'test');
    }
    public function get(string $uri, array $options = []): ResponseInterface
    {
        $request = $this->requestFactory->createRequest('GET',$uri);
        return $this->sendRequest($request);
    }
}
