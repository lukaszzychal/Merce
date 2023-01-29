<?php

namespace App\Client\Factory;

use App\Client\Factory\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class AdapterFactory implements FactoryInterface
{
    public function requestFactory(): RequestFactoryInterface
    {
        return new AdapterRequestFactory();
    }
    public function resposneFactory(): ResponseFactoryInterface
    {
        return new AdapterResposneFactory();
    }
    public function streamFactory(): StreamFactoryInterface
    {
        return new AdapterStreamFactory();
    }
}
