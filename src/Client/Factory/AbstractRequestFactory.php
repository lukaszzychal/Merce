<?php

declare(strict_types=1);

namespace App\Client\Factory;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface as PsrRequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

abstract class AbstractRequestFactory implements  RequestFactoryInterface
{
    public function __construct(
        protected ?PsrRequestFactoryInterface $requestFactory = null
    ) {
        $this->requestFactory = $requestFactory ?? new Psr17Factory();
    }

    public function createRequest(string $method, $uri): RequestInterface
    {
        return $this->requestFactory->createRequest($method, $uri);
    }

    public function createRequestWithHeaders(
        string $method,
        string $uri,
        array $headers = []
    ): RequestInterface
    {
        $request = $this->createRequest($method, $uri);
        $request = $this->addHeadersToRequest($request, $headers);
        return $request;
    }

    public function addHeadersToRequest(RequestInterface &$request, array $headers = []): RequestInterface
    {
        foreach ($headers as $header => $value) {
           $request =  $request->withAddedHeader($header, $value);
        }

        return $request;
    }
}
