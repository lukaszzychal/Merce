<?php

namespace App\Tests\Client\Integration;
use App\Client\Enum\HttpStatus;
use App\Client\Factory\ProxyFactory;
use App\Client\ResponseDTO;
use App\Tests\Client\Fake\FakeClient;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @group inte_client
 */
class ClientTest extends TestCase
{
    private $anyCodeStatus = HttpStatus::CREATED;
    private $anyReasonPhrase = 'any Reason Phrase ';
    private $anyBody = 'any Text';
    private $anyProtocolVersion ='1.1';
    private $anyHeaders = [
       'content-type' => 'aplication/json'
   ];

    public function testGiveClientWithResponseDataWhenCallMethodReturnCorectPsrResposne(): void
    {
       

        $fakeClient = new FakeClient();
        $resposneDTO = new ResponseDTO(
            $this->anyCodeStatus,
            $this->anyReasonPhrase,
            $this->anyBody,
            $this->anyProtocolVersion,
            $this->anyHeaders
        );
        $resposne = $fakeClient->buildResposnePsr($resposneDTO);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
        $this->assertSame($this->anyCodeStatus, $resposne->getStatusCode());
        $this->assertInstanceOf(StreamInterface::class, $resposne->getBody());
        $this->assertSame($this->anyBody, (string) $resposne->getBody());
        $this->assertTrue($resposne->hasHeader('content-type'));
        $this->assertSame('aplication/json', $resposne->getHeaders()['content-type'][0]);
        $this->assertSame($this->anyReasonPhrase, $resposne->getReasonPhrase());
        $this->assertSame($this->anyProtocolVersion, $resposne->getProtocolVersion());
    }

    public function testtestGiveReqestExecuteImplSendReqestReturnResposneData(): void
    {
        $anyCodeStatus = HttpStatus::OK;


        $factory = new ProxyFactory();
        $reqestStub = $this->createStub(RequestInterface::class);
        $fakeClient = new FakeClient();
        $responseDTO = $fakeClient->execute($reqestStub);

        $this->assertSame($anyCodeStatus, $responseDTO->codeStatus);
        $this->assertSame($this->anyReasonPhrase, $responseDTO->reasonPhrase);
        $this->assertSame($this->anyBody, $responseDTO->body);
        $this->assertSame($this->anyProtocolVersion, $responseDTO->protocolVersion);
        $this->assertSame($this->anyHeaders, $responseDTO->headers);
    }

    public function testMethodName(): void
    {
        $requestStub = $this->createStub(RequestInterface::class);

        $fakeClient = new FakeClient();
        $resposne = $fakeClient->sendRequest($requestStub);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
    }

}
