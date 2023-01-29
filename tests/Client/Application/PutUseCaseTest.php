<?php

declare(strict_types=1);

namespace App\Client;
use App\Client\Enum\HttpStatus;
use App\Tests\Client\Application\BaseTestCase;



class PutUseCaseTest extends BaseTestCase
{
    public function testGiveCurlClientWhenSendPutMethodWithDataReturnValidResposne(): void
    {
        $this->markTestIncomplete(' Incomplet curl implement');
        $resposne = $this->client->put('https://dummyjson.com/products/1',[
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                 'title' => 'iPhone Galaxy +1'
            ])
        ]);
        
        $this->assertSame(HttpStatus::OK, $resposne->getStatusCode());
        $contents = (string) $resposne->getBody();
        $this->assertJson($contents);
        $contentsArray = json_decode($contents, true);
        $this->assertIsArray($contentsArray);
        $this->assertGreaterThan(0, count($contentsArray));
        $this->assertArrayHasKey('title',$contentsArray);
        $this->assertSame('iPhone Galaxy +1', $contentsArray['title']);
    }



    public function testGiveCurlClientWhenSendPutMethodWithDataReturnInValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
      
    }

    public function testGiveCurlClientWhenSendPathMethodWithDataReturnValidResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
      
    }
}
