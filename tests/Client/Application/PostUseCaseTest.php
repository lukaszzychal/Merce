<?php

declare(strict_types=1);

namespace App\Client;
use App\Client\Enum\HttpStatus;
use App\Tests\Client\Application\BaseTestCase;
use App\Tests\Client\Provider\ShareData;



class PostUseCaseTest extends BaseTestCase
{
    public function testGiveCurlClientWhenSendPostMethodWithDataReturnValidResposne(): void
    {
        $resposne = $this->client->post('https://dummyjson.com/products/add',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                 'title' => 'BMW Pencil'
            ])
        ]);
    
        $this->assertSame(HttpStatus::OK, $resposne->getStatusCode());
        $this->assertStringContainsString('101', (string) $resposne->getBody());
    }


}
