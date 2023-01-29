<?php

declare(strict_types=1);

namespace App\Tests\Client\Fake;

use App\Client\Factory\AbstractRequestFactory;
use Psr\Http\Message\RequestFactoryInterface as PsrRequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

class FakeRequestFactory extends AbstractRequestFactory
{
    public function __construct(private RequestInterface $request, PsrRequestFactoryInterface $requestFactory = null)
    {
        parent::__construct($requestFactory);
    }
   public function createRequest(string $method, $uri): RequestInterface
   {
       $this->request->withMethod($method);
       return $this->request;
   }

   public function getFactory(): PsrRequestFactoryInterface
   {
       return $this->requestFactory;
   }
}
