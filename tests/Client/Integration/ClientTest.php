<?php

namespace App\Tests\Client\Integration;
use App\Client\Enum\HttpStatus;
use App\Client\Factory\ProxyFactory;
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
        $resposne = $fakeClient->buildResposnePsr(
            $this->anyCodeStatus,
            $this->anyReasonPhrase,
            $this->anyBody,
            $this->anyProtocolVersion,
            $this->anyHeaders
        );

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
        [$codeStatus, $reasonPhrase, 
        $body, $protocolVersion,
        $headers ] = $fakeClient->execute($reqestStub);

        $this->assertSame($anyCodeStatus, $codeStatus);
        $this->assertSame($this->anyReasonPhrase, $reasonPhrase);
        $this->assertSame($this->anyBody, $body);
        $this->assertSame($this->anyProtocolVersion, $protocolVersion);
        $this->assertSame($this->anyHeaders, $headers);
    }

    public function testMethodName(): void
    {
        $requestStub = $this->createStub(RequestInterface::class);

        $fakeClient = new FakeClient();
        $resposne = $fakeClient->sendRequest($requestStub);

        $this->assertInstanceOf(ResponseInterface::class, $resposne);
    }

}
