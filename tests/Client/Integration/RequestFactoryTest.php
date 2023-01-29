<?php

namespace App\Tests\Client\Integration;

use App\Client\Enum\HttpMethod;
use App\Client\Exception\InvalidMethodException;
use App\Client\Exception\InvalidUriException;
use App\Client\Factory\AbstractRequestFactory;
use App\Client\Factory\ProxyRequestFactory;
use App\Tests\Client\Provider\ShareData;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

/**
 * @group inte_request_factory
 * @group request_factory
 */
class RequestFactoryTest extends TestCase
{
    public function testUSeDefaultFactory(): void
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

    public function testUseInvalidHttpMethodFactory(): void
    {
        $invalidMethod = 'invalid method';
        $validHost = ShareData::HOST;

        $reqestFactory = new ProxyRequestFactory();

        $this->expectException(InvalidMethodException::class);
        $this->expectExceptionMessage(
            "Invalid HTTP METHOD. Give 'invalid method' use [ GET, POST, PUT, PATH, DELETE ] ."
        );

        $reqestFactory->createRequest($invalidMethod, $validHost);

    }

    
    public function testUseInvalidUriFactory(): void
    {
        $validMethod = HttpMethod::POST;
        $invalidHost = 'invalid host';

        $reqestFactory = new ProxyRequestFactory();

        $this->expectException(InvalidUriException::class);
        $this->expectExceptionMessage("Invalid URI. Give 'invalid host' .");
        
        $reqestFactory->createRequest($validMethod, $invalidHost);

    }

    public function testUseConcretFactory(): void
    {
        $reqestFactory = new ProxyRequestFactory(
            new Psr17Factory()
        );

        $reqest = $reqestFactory->createRequest('GET', 'http://test-api');

        $this->assertInstanceOf(AbstractRequestFactory::class, $reqestFactory);
        $this->assertInstanceOf(RequestInterface::class, $reqest);
    }

    public function testAddHeadersToRequest(): void
    {
        $reqestFactory = new ProxyRequestFactory();
        $anyHeaders = [
           'Any-Header' => 'any value header'
        ];
        $request = $reqestFactory->createRequest(HttpMethod::GET, ShareData::HOST);
        $this->assertFalse($request->hasHeader('Any-Header'));

        $request = $reqestFactory->addHeadersToRequest($request, $anyHeaders);
        $this->assertTrue($request->hasHeader('Any-Header'));
        $this->assertSame('any value header', $request->getHeaders()['Any-Header'][0]);
    }


    public function testCreateRequestWithHeaders(): void
    {
        $reqestFactory = new ProxyRequestFactory();
        $anyHeaders = [
           'Any-Header' => 'any value header'
        ];

        $request = $reqestFactory->createRequestWithHeaders(HttpMethod::GET, ShareData::HOST, $anyHeaders);
        $this->assertTrue($request->hasHeader('Any-Header'));
        $this->assertSame('any value header', $request->getHeaders()['Any-Header'][0]);
    }
}
