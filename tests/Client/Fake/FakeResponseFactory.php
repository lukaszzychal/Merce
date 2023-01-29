<?php

declare(strict_types=1);

namespace App\Tests\Client\Fake;

use App\Client\Factory\AbstractResposneFactory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class FakeResponseFactory extends AbstractResposneFactory
{
    public function __construct(private ResponseInterface $response, ResponseFactoryInterface $responseFactory = null)
    {
        parent::__construct($responseFactory);
    }
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return $this->response;
    }

   public function getFactory(): ResponseFactoryInterface
   {
       return $this->factory;
   }
}
