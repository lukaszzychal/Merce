<?php

namespace App\Tests\Integration;

use App\Client\ClientInterface;
use App\Client\CurlClient;
use App\Client\Enum\HttpMethod;
use App\Client\Enum\HttpStatus;
use App\Tests\Provider\ProviderData;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @group inte
 * @group inte_curl_client
 */
class CurlClientTest extends TestCase
{
    private const HOST = 'http://localhost';
    public function testCurlClient(): void
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest(HttpMethod::METHOD_HTTP_GET, self::HOST);
        $curlClient = new CurlClient($factory, $factory);
        $curlClient->sendRequest($request);

        $resposne = $curlClient->sendRequest($request);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(HttpStatus::STATUS_OK, $resposne->getStatusCode());
    }

    public function testGiveCurlClientCallGetMethodReturnSuccess(): void
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest(HttpMethod::METHOD_HTTP_GET, self::HOST);
        $curlClient = new CurlClient($factory, $factory);

        $resposne = $curlClient->get('localhost');

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(HttpStatus::STATUS_OK, $resposne->getStatusCode());
    }
}
