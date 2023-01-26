<?php

namespace App\Tests\Unit;

use App\Client\CurlClient;
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
    public function testCurlClient(): void
    {
        $resposneMock = $this->createStub(ResponseInterface::class);
        $resposneMock->method('getStatusCode')->willReturn(200);
        
        $resposneFactoryMock = $this->createMock(ResponseFactoryInterface::class);
        $resposneFactoryMock->expects($this->once())
            ->method('createResponse')
            ->withConsecutive([200, 'test'])
            ->willReturn($resposneMock);
        $requestMock =  $this->createStub(RequestInterface::class);
        
        $curlClient = new CurlClient($resposneFactoryMock);
        $resposne = $curlClient->sendRequest($requestMock);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(200, $resposne->getStatusCode());
        
        
    }
}
