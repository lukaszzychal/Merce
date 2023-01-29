<?php

declare(strict_types=1);

namespace App\Tests\Client\Application;
use App\Client\Enum\HttpStatus;
use App\Client\Exception\InvalidUriException;
use App\Tests\Client\Provider\ShareData;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 *
 * @group app_get
 */
class GetUseCaseTest extends BaseTestCase
{
    public function testGiveCurlClientWhenSendGetMethodWithoutOptionsREturnValidResponse(): void
    {
        $resposne = $this->client->get(ShareData::URI_JSON_DATA);

        $this->assertResposne($resposne);
        $this->assertSame(HttpStatus::OK, $resposne->getStatusCode());
    }

    private function assertResposne(ResponseInterface $resposne): void
    {
        $this->assertInstanceOf(ResponseInterface::class, $resposne);
    
        $this->assertInstanceOf(StreamInterface::class, $resposne->getBody());
        $contents = (string) $resposne->getBody();
        $this->assertJson($contents);
        $contentsArray = json_decode($contents, true);
        $this->assertIsArray($contentsArray);
        $this->assertGreaterThan(0, count($contentsArray));
    }

    /**
 *
 * @group app_get_1
 */
    public function testGiveCurlClientWhenSendGetMethodWithOptionsREturnValidResponse(): void
    {
        $resposne = $this->client->get(ShareData::URI_JSON_DATA, [
            'headers' => [
                'Accept' => 'my header'
            ]
        ]);

        $this->assertResposne($resposne);
        $this->assertSame(200, $resposne->getStatusCode());
    }

    public function testGiveCurlClientWhenSendGetToNonExistEndpointReturnNonFoundResponse(): void
    {
        
        $resposne = $this->client->get('https://jsonplaceholder.typicode.com/endpoint-not-exist/1');
        
        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame(HttpStatus::NOT_FOUND, $resposne->getStatusCode());
        $this->assertInstanceOf(StreamInterface::class, $resposne->getBody());
    
    }

    public function testGiveCurlClientWhenSendGetMethodWithEmptyUriReturnBadRequestResposne(): void
    {
        $this->expectException(InvalidUriException::class);
        $this->client->get('');
    }

   



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
