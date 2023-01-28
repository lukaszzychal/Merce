<?php

declare(strict_types=1);

namespace App\Client\Factory;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

abstract class AbstractRequestFactory implements RequestFactoryInterface
{
    public function __construct(
        protected ?RequestFactoryInterface $requestFactory = null
    ) {
        $this->requestFactory = $requestFactory ?? new Psr17Factory();
    }

    public function createRequest(string $method, $uri): RequestInterface
    {
        return $this->requestFactory->createRequest($method, $uri);
    }
}
