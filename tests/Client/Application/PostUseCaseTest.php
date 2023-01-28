<?php

declare(strict_types=1);

namespace App\Client;
use App\Tests\Client\Application\BaseTestCase;



class PostUseCaseTest extends BaseTestCase
{
    public function testGiveCurlClientWhenSendPostMethodWithDataReturnValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
        $resposne = $this->client->post('http://localhost/users', [
            'body' => json_encode([
                'data1' => 'value1'
            ]),
            'headers' => [ ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(201, $resposne->getStatus());
    }
}
