<?php

namespace App\Tests\Client\Unit;

use App\Client\Factory\AbstractRequestFactory;
use App\Tests\Client\Fake\FakeRequestFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

/**
 * @group unit_request_factory
 * @group request_factory
 */
class RequestFactoryTest extends TestCase
{
    public function testCreateDefaultFactory(): void
    {
        $reqestFactory = new FakeRequestFactory(
            $this->createStub(RequestInterface::class)
        );

        $reqest = $reqestFactory->createRequest('GET', 'http://test-api');

        $this->assertInstanceOf(AbstractRequestFactory::class, $reqestFactory);
        $this->assertInstanceOf(RequestInterface::class, $reqest);
        $this->assertInstanceOf(Psr17Factory::class, $reqestFactory->getFactory());
    }

    public function testCreateConcretFactory(): void
    {
        $reqestFactory = new FakeRequestFactory(
            $this->createStub(RequestInterface::class),
            $this->createStub(RequestFactoryInterface::class)
        );

        $reqest = $reqestFactory->createRequest('GET', 'http://test-api');

        $this->assertInstanceOf(AbstractRequestFactory::class, $reqestFactory);
        $this->assertInstanceOf(RequestInterface::class, $reqest);
        $this->assertNotInstanceOf(Psr17Factory::class, $reqestFactory->getFactory());
    }
}
