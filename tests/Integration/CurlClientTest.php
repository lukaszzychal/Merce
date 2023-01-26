<?php

namespace App\Tests\Integration;

use App\Client\CurlClient;
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
    public function testCurlClient(): void
    {
        $factory = new Psr17Factory();
        $request = $factory->createRequest('get','localhost');
        $curlClient = new CurlClient($factory);
        $curlClient->sendRequest($request);

        $resposne = $curlClient->sendRequest($request);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(200, $resposne->getStatusCode());
    }
}
