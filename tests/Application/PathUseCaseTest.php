<?php

namespace App\Client;

use App\Client\CurlClient;
use PHPUnit\Framework\TestCase;

class PathUseCaseTest extends TestCase
{
    private ClientInterface $client;
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new CurlClient();
    }

    public function testGiveCurlClientWhenSendPathMethodWithDataReturnInValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->path('http://localhost/users', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [
                'content-type' => 'aplication/json'
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(400, $resposne->getStatus());
    }

     public function testGiveCurlClientWhenSendPathMethodWithDataReturnValidResposne(): void
     {
         $this->markTestSkipped("Not Implemetation. ToDo");
         $resposne = $this->client->path('http://localhost/users', [
             'body' => json_encode([
                 'data1' => 'value1'
             ]),
             'headers' => [
                 'content-type' => 'aplication/json'
             ]
         ]);

         $this->assertInstanceOf(ResposneInterface::class, $resposne);
         $this->assertSame(400, $resposne->getStatus());
     }
}
