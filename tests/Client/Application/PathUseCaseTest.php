<?php

declare(strict_types=1);

namespace App\Client;
use App\Tests\Client\Application\BaseTestCase;



class PathUseCaseTest extends BaseTestCase
{
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
