<?php

declare(strict_types=1);

namespace App\Tests\Client\Application;
use App\Tests\Client\Provider\ShareData;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 *
 * @group app_get
 */
class GetUseCaseTest extends BaseTestCase
{
    // public function testGiveCurlClientWhenSendGetMethodWithoutOptionsREturnValidResponse(): void
    // {
    //     $resposne = $this->client->get(ShareData::URI_JSON_DATA);
        
    //     $this->assertInstanceOf(ResponseInterface::class, $resposne);
    //     $this->assertSame(200, $resposne->getStatusCode());
    //     $this->assertInstanceOf(StreamInterface::class, $resposne->getBody());
    //     $this->assertStringContainsString("any Text", (string) $resposne->getBody()->getContents());
    // }

    public function testGiveCurlClientWhenSendGetMethodWithOptionsREturnValidResponse(): void
    {
        $resposne = $this->client->get(ShareData::URI_JSON_DATA, [
            'headers' => [
                'Accept' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(200, $resposne->getStatusCode());
        $this->assertTrue($resposne->hasHeader('content-type'));
    }

    public function testGiveCurlClientWhenSendGetMethodWithEmptyUriReturnBadRequestResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('');

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(400, $resposne->getStatusCode());
    }

    public function testGiveCurlClientWhenSendGetMethodWithNotExistUriReturnNotFoundResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/NotExistPage');

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatusCode());
    }



    public function testGiveCurlClientWhenSendGetMethodWithRightAuthJWTReturnSuccessResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-jwt', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [
                'Accept' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatusCode());
    }

    public function testGiveCurlClientWhenSendGetMethodWithWrongAuthJWTReturnFailedResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-jwt', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [
                'Accept' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatusCode());
    }


    public function testGiveCurlClientWhenSendGetMethodWithRightAuthBasicReturnSuccessResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-basic', [
            'headers' => [
                'Accept' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatusCode());
    }

    public function testGiveCurlClientWhenSendGetMethodWithWrongAuthBasicReturnFailedResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-basic', [
            'headers' => [
                'Accept' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatusCode());
    }
}
