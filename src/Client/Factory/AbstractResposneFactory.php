<?php

declare(strict_types=1);

namespace App\Client\Factory;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractResposneFactory implements ResponseFactoryInterface
{
    public function __construct(
        protected ?ResponseFactoryInterface $factory = null
    ) {
        $this->factory = $factory ?? new Psr17Factory();
    }

    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return $this->factory->createResponse($code, $reasonPhrase);
    }
}
