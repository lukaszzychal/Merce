<?php

declare(strict_types=1);

namespace App\Client\Factory;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface as PsrResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

abstract class AbstractResposneFactory implements ResponseFactoryInterface
{
    public function __construct(
        protected ?PsrResponseFactoryInterface $factory = null
    ) {
        $this->factory = $factory ?? new Psr17Factory();
    }

    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface
    {
        return $this->factory->createResponse($code, $reasonPhrase);
    }

    public function createResponseFrom(
        int $code , string $reasonPhrase, StreamInterface $stream , array $headers = []
        ): ResponseInterface
    {
        $resposne = $this->factory->createResponse($code, $reasonPhrase);
        $resposne = $resposne->withBody($stream);
        $resposne->getBody()->seek(0);
        $this->addHeadersToResposne($resposne, $headers);

        return $resposne;
    }

    public function addHeadersToResposne(ResponseInterface &$resposne, array $headers = []): ResponseInterface
    {
        foreach ($headers as $header => $value) {
            $resposne =  $resposne->withAddedHeader($header, $value);
         }
        return $resposne;
    }
}
