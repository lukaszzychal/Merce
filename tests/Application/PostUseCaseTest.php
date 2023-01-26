<?php

namespace App\Client;

use PHPUnit\Framework\TestCase;

class PostUseCaseTest extends TestCase
{
    private ClientInterface $client;
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = new CurlClient();
    }


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
