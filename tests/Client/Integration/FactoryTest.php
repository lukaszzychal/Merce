<?php

namespace App\Tests\Integration;

use App\Client\Factory\ProxyFactory;
use App\Client\Factory\ProxyRequestFactory;
use App\Client\Factory\ProxyResposneFactory;
use App\Client\Factory\ProxyStreamFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 *
 * @group inte_factory
  * @group factory
 */
class FactoryTest extends TestCase
{
    public function testFactoryCreateSubFactory(): void
    {
        $proxyfactory = new ProxyFactory();
        
        $requestFactory = $proxyfactory->requestFactory();
        $resposneFactory = $proxyfactory->resposneFactory();
        $streamFactory = $proxyfactory->streamFactory();

        $this->assertInstanceOf(RequestFactoryInterface::class, $requestFactory);
        $this->assertInstanceOf(ProxyRequestFactory::class, $requestFactory);
        $this->assertInstanceOf(ResponseFactoryInterface::class, $resposneFactory);
        $this->assertInstanceOf(ProxyResposneFactory::class, $resposneFactory);
        $this->assertInstanceOf(StreamFactoryInterface::class, $streamFactory);
        $this->assertInstanceOf(ProxyStreamFactory::class, $streamFactory);
    }
}
