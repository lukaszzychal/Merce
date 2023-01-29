<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Enum\HttpMethod;
use App\Client\Factory\FactoryInterface;
use App\Client\Factory\ProxyFactory;
use App\Client\Factory\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use App\Client\Factory\ResponseFactoryInterface;
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

     public function execute(RequestInterface $request): ResponseDTO
     {
        return new ResponseDTO(
            200,
             'any Reason Phrase ',
              'any Text', 
               [
                'content-type' => 'aplication/json'
            ]
        );
     
     }
    public function buildResposnePsr(
        ResponseDTO $responseDTO
          ): ResponseInterface
    {
        $stream = $this->streamFactory->createStream($responseDTO->body);
        $stream->seek(0);

        $resposne = $this->resposneFactory->createResponseFrom(
            $responseDTO->codeStatus,
            $responseDTO->reasonPhrase,
            $stream,
            $responseDTO->headers
        );

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
        $responseDTO = $this->execute($request);
        $response = $this->buildResposnePsr( $responseDTO);
      
        return $response;
    }
    public function get(string $uri, array $options = []): ResponseInterface
    {
        $request = $this->requestFactory->createRequestWithHeaders(
            HttpMethod::GET,
            $uri,
            $options['headers'] ?? []
        );
        
        return $this->sendRequest($request);
    }

}
