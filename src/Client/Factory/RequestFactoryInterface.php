<?php

namespace App\Client\Factory;

use Psr\Http\Message\RequestFactoryInterface as PsrRequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
interface RequestFactoryInterface extends PsrRequestFactoryInterface
{
    public function createRequestFrom(
        string $method,
        string|UriInterface $uri,
        array $headers = [],
        StreamInterface $stream = null
    ): RequestInterface;

    public function addHeadersToRequest(RequestInterface &$request, array $headers = []): RequestInterface;

}
