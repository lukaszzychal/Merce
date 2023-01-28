<?php

namespace App\Client\Factory;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

interface FactoryInterface
{
    public function requestFactory(): RequestFactoryInterface;
    public function resposneFactory(): ResponseFactoryInterface;
    public function streamFactory(): StreamFactoryInterface;
}
