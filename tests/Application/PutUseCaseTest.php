<?php

namespace App\Client;

use PHPUnit\Framework\TestCase;
use App\Client\CurlClient;

class PutUseCaseTest extends TestCase
{
    private ClientInterface $client;
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new CurlClient();
    }


    public function testGiveCurlClientWhenSendPutMethodWithDataReturnValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->put('http://localhost/users', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [ ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(201, $resposne->getStatus());
        $this->assertSame(204, $resposne->getStatus());
    }



    public function testGiveCurlClientWhenSendPutMethodWithDataReturnInValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->put('http://localhost/users', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [ ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(400, $resposne->getStatus());
    }

    public function testGiveCurlClientWhenSendPathMethodWithDataReturnValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->put('http://localhost/users', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [ ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(200, $resposne->getStatus());
    }
}
