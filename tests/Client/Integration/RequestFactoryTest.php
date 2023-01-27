<?php

namespace App\Tests\Client\Integration;

use App\Client\Enum\HttpMethod;
use App\Client\Factory\AbstractRequestFactory;
use App\Client\Factory\ProxyRequestFactory;
use App\Tests\Client\Fake\FakeRequestFactory;
use App\Tests\Client\Provider\ShareData;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

/**
 * @group inte_request_factory
 */
class RequestFactoryTest extends TestCase
{
    public function testCreateDefaultFactory(): void
    {
        $method = HttpMethod::GET;
        $host = ShareData::HOST;
        $reqestFactory = new ProxyRequestFactory();

        $reqest = $reqestFactory->createRequest($method, $host);

        $this->assertInstanceOf(AbstractRequestFactory::class, $reqestFactory);
        $this->assertInstanceOf(ProxyRequestFactory::class, $reqestFactory);
        $this->assertInstanceOf(RequestInterface::class, $reqest);
        $this->assertSame($method, $reqest->getMethod());
        $this->assertSame($host, (string) $reqest->getUri());
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
