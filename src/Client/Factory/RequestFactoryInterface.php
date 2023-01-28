<?php

namespace App\Client\Factory;

use Psr\Http\Message\RequestFactoryInterface as PsrRequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
interface RequestFactoryInterface extends PsrRequestFactoryInterface
{
    public function createRequestWithHeaders(
        string $method,
        string $uri,
        array $headers = []
    ): RequestInterface;

    public function addHeadersToRequest(RequestInterface $request, array $headers = []): RequestInterface;

}
