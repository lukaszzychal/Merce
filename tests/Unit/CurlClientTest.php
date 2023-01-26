<?php

namespace App\Tests\Unit;

use App\Client\CurlClient;
use App\Client\Enum\HttpMethod;
use App\Client\Enum\HttpStatus;
use App\Tests\Provider\ProviderData;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 * @group unit_curl_client
 * @group unit
 */
class CurlClientTest extends TestCase
{
    private const HOST = 'http://localhost';
    public function testGiveCurlClientCallSendRequestReturnSuccess(): void
    {
        $resposneMock = $this->createStub(ResponseInterface::class);
        $resposneMock->method('getStatusCode')->willReturn(HttpStatus::STATUS_OK);

        $resposneFactoryMock = $this->createMock(ResponseFactoryInterface::class);
        $resposneFactoryMock->expects($this->once())
            ->method('createResponse')
            ->withConsecutive([HttpStatus::STATUS_OK])
            ->willReturn($resposneMock);

        $requestFactoryMock = $this->createStub(RequestFactoryInterface::class);
        $requestMock =  $this->createStub(RequestInterface::class);

        $curlClient = new CurlClient($resposneFactoryMock, $requestFactoryMock);
        $resposne = $curlClient->sendRequest($requestMock);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(HttpStatus::STATUS_OK, $resposne->getStatusCode());
    }

    public function testGiveCurlClientCallGetMethodReturnSuccess(): void
    {
        $resposneMock = $this->createStub(ResponseInterface::class);
        $resposneMock->method('getStatusCode')->willReturn(HttpStatus::STATUS_OK);

        $resposneFactoryMock = $this->createMock(ResponseFactoryInterface::class);
        $resposneFactoryMock->expects($this->once())
            ->method('createResponse')
            ->withConsecutive([HttpStatus::STATUS_OK])
            ->willReturn($resposneMock);
        $requestMock =  $this->createStub(RequestInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $requestFactoryMock->expects($this->once())
            ->method('createRequest')->withConsecutive([HttpMethod::METHOD_HTTP_GET, self::HOST])
            ->willReturn($requestMock);


        $curlClient = new CurlClient($resposneFactoryMock, $requestFactoryMock);
        $resposne = $curlClient->get(self::HOST);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(HttpStatus::STATUS_OK, $resposne->getStatusCode());
    }
}
