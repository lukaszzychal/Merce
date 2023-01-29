<?php

namespace App\Tests\Client\Application;
use PHPUnit\Framework\TestCase;

class AuthUseCaseTest extends TestCase
{
    

    public function testGiveCurlClientWhenSendGetMethodWithRightAuthJWTReturnSuccessResposne(): void
    {
        $this->markTestIncomplete("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-jwt', [
            'headers' => [
                'Accept' => 'aplication/json',
                "Authorization" => "Bearer ANY-TOKEN"
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(HttpStatus::OK, $resposne->getStatusCode());
    }

    public function testGiveCurlClientWhenSendGetMethodWithWrongAuthJWTReturnFailedResposne(): void
    {
        $this->markTestIncomplete("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-jwt', [
            'headers' => [
                'Accept' => 'aplication/json',
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(HttpStatus::UNAUTHORIZED, $resposne->getStatusCode());
    
    }


    public function testGiveCurlClientWhenSendGetMethodWithRightAuthBasicReturnSuccessResposne(): void
    {
        $this->markTestIncomplete("Not Implemetation. ToDo");
        $resposne = $this->client->get('http://localhost/auth-basic', [
            'headers' => [
                'Accept' => 'aplication/json',
                'Authorization'=> sprintf('Basic $s', base64_encode('any_login:any_pasword'))
            ]
        ]);

        $this->assertInstanceOf(ResposneInterface::class, $resposne);
        $this->assertSame(404, $resposne->getStatusCode());
    }

    public function testGiveCurlClientWhenSendGetMethodWithWrongAuthBasicReturnFailedResposne(): void
    {
        $this->markTestSkipped("Not Implemetation. ToDo");
    }
}
