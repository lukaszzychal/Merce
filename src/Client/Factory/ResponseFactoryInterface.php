<?php

namespace App\Client\Factory;

use Psr\Http\Message\ResponseFactoryInterface as PsrResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

interface ResponseFactoryInterface extends PsrResponseFactoryInterface
{
    public function createResponseFrom(
        int $code , string $reasonPhrase, StreamInterface $stream ,  array $headers = []
    ): ResponseInterface;

    public function addHeadersToResposne(ResponseInterface &$resposne, array $headers = []): ResponseInterface;
}
