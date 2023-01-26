<?php

namespace App\Tests\Client;

use App\Client\CurlClient;
use PHPUnit\Framework\TestCase;

class DeleteUseCaseTest extends TestCase
{
    private ClientInterface $client;
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new CurlClient();
    }


    public function testGiveCurlClientWhenSendDeleteMethodaReturnValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->delete('http://localhost/users/1', [
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(200, $resposne->getStatus());
    }

    public function testGiveCurlClientWhenSendDeleteMethodReturnInValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->delete('http://localhost/users/1', [
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(400, $resposne->getStatus());
    }
}
