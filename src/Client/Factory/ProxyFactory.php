<?php

namespace App\Client\Factory;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ProxyFactory implements FactoryInterface
{
    public function requestFactory(): RequestFactoryInterface
    {
        return new ProxyRequestFactory();
    }
    public function resposneFactory(): ResponseFactoryInterface
    {
        return new ProxyResposneFactory();
    }
    public function streamFactory(): StreamFactoryInterface
    {
        return new ProxyStreamFactory();
    }
}
