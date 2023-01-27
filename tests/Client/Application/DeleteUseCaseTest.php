<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Client\ClientInterface;
use App\Client\CurlClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;

class DeleteUseCaseTest extends BaseTestCaseTest
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
