<?php

declare(strict_types=1);

namespace App\Client;

use App\Client\Enum\HttpMethod;
use App\Client\Enum\HttpStatus;
use App\Client\Exception\ClientException;
use App\Client\Exception\InvalidMethodException;
use App\Client\Exception\InvalidUriException;
use App\Client\Exception\NetworkException;
use App\Client\Exception\RequestException;
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

    abstract public function execute(RequestInterface $request): ResponseDTO;
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
        try {
            $responseDTO = $this->execute($request);
            $response = $this->buildResposnePsr( $responseDTO);
          
            return $response;
        } catch (RequestException | ClientException | NetworkException $e) {
            throw $e;
        }catch (InvalidMethodException | InvalidUriException $e) {
            throw $e;
        }catch (\Throwable $e) {
            throw new ClientException('Error Client. Please try again. ', HttpStatus::INTERNAL_SERVER_ERROR);
        }
    
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
