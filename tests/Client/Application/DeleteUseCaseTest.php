<?php

declare(strict_types=1);

namespace App\Tests\Application;
use App\Tests\Client\Application\BaseTestCase;

class DeleteUseCaseTest extends BaseTestCase
{
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
