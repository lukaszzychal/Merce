<?php

namespace App\Client;

use PHPUnit\Framework\TestCase;

class GetUseCaseTest extends TestCase
{
    private ClientInterface $client;
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new CurlClient();
    }

    public function testGiveCurlClientWhenSendGetMethodWithoutOptionsREturnValidResponse(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost');

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(200, $resposne->getStatus());
        $this->assertStringContainsString("some tekst", $resposne->getBody());
    }

    public function testGiveCurlClientWhenSendGetMethodWithOptionsREturnValidResponse(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost', [
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(200, $resposne->getStatus());
        $this->assertStringContainsString("some tekst", $resposne->getBody());
    }

    public function testGiveCurlClientWhenSendGetMethodWithEmptyUriReturnBadRequestResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('');

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(400, $resposne->getStatus());
    }

    public function testGiveCurlClientWhenSendGetMethodWithNotExistUriReturnNotFoundResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/NotExistPage');

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatus());
    }



    public function testGiveCurlClientWhenSendGetMethodWithRightAuthJWTReturnSuccessResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-jwt', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatus());
    }

    public function testGiveCurlClientWhenSendGetMethodWithWrongAuthJWTReturnFailedResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-jwt', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatus());
    }


    public function testGiveCurlClientWhenSendGetMethodWithRightAuthBasicReturnSuccessResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-basic', [
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatus());
    }

    public function testGiveCurlClientWhenSendGetMethodWithWrongAuthBasicReturnFailedResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-basic', [
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatus());
    }
}
