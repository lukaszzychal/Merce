<?php

declare(strict_types=1);

namespace App\Client\Factory;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface;

abstract class AbstractRequestFactory implements RequestFactoryInterface
{
    public function __construct(
        protected ?RequestFactoryInterface $requestFactory = null
    )
    {
        $this->requestFactory = $requestFactory ?? new Psr17Factory();
    }
}
