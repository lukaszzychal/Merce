<?php

declare(strict_types=1);

namespace App\Tests\Client\Integration;

use App\Client\Enum\HttpStatus;
use App\Client\Factory\AbstractResposneFactory;
use App\Client\Factory\AdapterResposneFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @group inte_response_factory
  * @group response_factory
 */
class ResponseFactoryTest extends TestCase
{
    public function testUseDefaultFactory(): void
    {
        $factory = new AdapterResposneFactory();

        $reqest = $factory->createResponse(HttpStatus::CREATED);

        $this->assertInstanceOf(AbstractResposneFactory::class, $factory);
        $this->assertInstanceOf(ResponseInterface::class, $reqest);
    }

    public function testUseConcretFactory(): void
    {
        $factory = new AdapterResposneFactory(
            new Psr17Factory()
        );

        $reqest = $factory->createResponse(HttpStatus::CREATED);

        $this->assertInstanceOf(AbstractResposneFactory::class, $factory);
        $this->assertInstanceOf(ResponseInterface::class, $reqest);
    }


    public function testAddHeadersToRequest(): void
    {
        $factory = new AdapterResposneFactory();
        $anyStatus = HttpStatus::NOT_FOUND;
        $anyHeaders = [
            'Any-Header' => 'any value header'
         ];
        
        $resposne = $factory->createResponse($anyStatus);
        $this->assertFalse($resposne->hasHeader('Any-Header'));

        $factory->addHeadersToResposne($resposne, $anyHeaders);
        $this->assertTrue($resposne->hasHeader('Any-Header'));
        $this->assertSame('any value header', $resposne->getHeaders()['Any-Header'][0]);

    }


    public function testCreateRequestWithHeaders(): void
    {
        $resposneFactory = new AdapterResposneFactory();
        $streamFactory = new AdapterStreamFactory();
        $anyHeaders = [
           'Any-Header' => 'any value header'
        ];
        $anyCode = HttpStatus::UNAUTHORIZED;
        $anyReasonPhrase = 'anyReasonPhrase';
        $anyStream = $streamFactory->createStream('any content');

        $resposne = $resposneFactory->createResponseFrom(
            $anyCode, $anyReasonPhrase, $anyStream, $anyHeaders
        );
        $this->assertTrue($resposne->hasHeader('Any-Header'));
        $this->assertSame('any value header', $resposne->getHeaders()['Any-Header'][0]);
        $this->assertSame($anyCode, $resposne->getStatusCode());
        $this->assertSame('any content', (string) $resposne->getBody());
        $this->assertSame($anyReasonPhrase, $resposne->getReasonPhrase());
        
    }

    


}
