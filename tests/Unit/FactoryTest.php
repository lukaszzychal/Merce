<?php

namespace App\Tests\Unit;
use App\Client\Factory\FactoryInterface;
use App\Client\Factory\ProxyFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * 
 * @group unit_factory
 */
class FactoryTest extends TestCase
{
    public function testBehaviorFactory(): void 
    {
        $proxyfactory = $this->createMock(FactoryInterface::class);

        $requestFactory = $proxyfactory->requestFactory();
        $resposneFactory = $proxyfactory->resposneFactory();
        $streamFactory = $proxyfactory->streamFactory();

        $this->assertInstanceOf(FactoryInterface::class, $proxyfactory);
        $this->assertInstanceOf(RequestFactoryInterface::class, $requestFactory);
        $this->assertInstanceOf(ResponseFactoryInterface::class, $resposneFactory);
        $this->assertInstanceOf(StreamFactoryInterface::class, $streamFactory);
        
    }
}
