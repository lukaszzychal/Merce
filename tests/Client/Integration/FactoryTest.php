<?php

namespace App\Tests\Integration;

use App\Client\Factory\AdapterFactory;
use App\Client\Factory\AdapterRequestFactory;
use App\Client\Factory\AdapterResposneFactory;
use App\Client\Factory\AdapterStreamFactory;
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
        $adapterfactory = new AdapterFactory();
        
        $requestFactory = $adapterfactory->requestFactory();
        $resposneFactory = $adapterfactory->resposneFactory();
        $streamFactory = $adapterfactory->streamFactory();

        $this->assertInstanceOf(RequestFactoryInterface::class, $requestFactory);
        $this->assertInstanceOf(AdapterRequestFactory::class, $requestFactory);
        $this->assertInstanceOf(ResponseFactoryInterface::class, $resposneFactory);
        $this->assertInstanceOf(AdapterResposneFactory::class, $resposneFactory);
        $this->assertInstanceOf(StreamFactoryInterface::class, $streamFactory);
        $this->assertInstanceOf(AdapterStreamFactory::class, $streamFactory);
    }
}
