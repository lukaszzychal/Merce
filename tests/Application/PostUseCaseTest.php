<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\CurlClient;
use App\Tests\Application\BaseTestCase;
use App\Tests\Application\BaseTestCaseTest;
use PHPUnit\Framework\TestCase;

class PostUseCaseTest extends BaseTestCaseTest
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
