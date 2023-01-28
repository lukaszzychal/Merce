<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Enum\HttpMethod;
use App\Client\Factory\FactoryInterface;
use App\Client\Factory\ProxyFactory;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

abstract class AbstractClient implements ClientInterface
{
    protected RequestFactoryInterface $requestFactory;
    protected ResponseFactoryInterface $resposneFactory;
    protected StreamFactoryInterface $streamFactory;

    public function __construct(
        ?FactoryInterface $factoryClient = null
    ) {
        $factoryClient = $factoryClient ?? new ProxyFactory();
        $this->requestFactory = $factoryClient->requestFactory();
        $this->resposneFactory = $factoryClient->resposneFactory();
        $this->streamFactory = $factoryClient->streamFactory();
    }

     public function execute(RequestInterface $request): array
     {
        return [200, 'any Reason Phrase ', 'any Text', '1.1', [
            'content-type' => 'aplication/json'
        ]];
     }
    public function buildResposnePsr(
        int $codeStatus, 
        string $reasonPhrase, 
        string $body,
         string $protocolVersion,
         array $headers = []
          ): ResponseInterface
    {
        $resposne =  $this->resposneFactory->createResponse($codeStatus, $reasonPhrase);
        $stream = $this->streamFactory->createStream($body);
        $stream->seek(0);
        $resposne = $resposne->withBody($stream);
        $resposne->withProtocolVersion($protocolVersion);
        foreach ($headers as $header => $value) {
            $resposne =  $resposne->withAddedHeader($header, $value);
         }
        $resposne->getBody()->seek(0);

        return $resposne;
    }

    /**
     * Sends a PSR-7 request and returns a PSR-7 response.
     *
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface If an error happens while processing the request.
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        [$codeStatus, $reasonPhrase, 
        $body, $protocolVersion,
        $headers ] = $this->execute($request);
        $response = $this->buildResposnePsr( 
            $codeStatus, $reasonPhrase, 
            $body, $protocolVersion,
            $headers
        );
      
        return $response;
    }
    public function get(string $uri, array $options = []): ResponseInterface
    {

        $request = $this->requestFactory->createRequest(HttpMethod::GET, $uri );

        if(isset($options['headers']))
        {
            foreach ($options['headers'] as $header => $value) {
                $request =  $request->withAddedHeader($header, $value);
             }
        }
        
        
        return $this->sendRequest($request);
    }

}
