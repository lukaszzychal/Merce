<?php

namespace App\Tests\Unit;

use App\Client\Factory\FactoryInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 *
 * @group unit_factory
 * @group factory
 */
class FactoryTest extends TestCase
{
    public function testInterfaceWhenCreateFactoryReturnConcreateTypeFactory(): void
    {
        $factory = $this->createMock(FactoryInterface::class);

        $requestFactory = $factory->requestFactory();
        $resposneFactory = $factory->resposneFactory();
        $streamFactory = $factory->streamFactory();

        $this->assertInstanceOf(FactoryInterface::class, $factory);
        $this->assertInstanceOf(RequestFactoryInterface::class, $requestFactory);
        $this->assertInstanceOf(ResponseFactoryInterface::class, $resposneFactory);
        $this->assertInstanceOf(StreamFactoryInterface::class, $streamFactory);
    }
}
