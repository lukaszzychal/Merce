<?php

declare(strict_types=1);

namespace App\Client\Factory;

use App\Client\Enum\HttpMethod;
use App\Client\Exception\InvalidMethodException;
use App\Client\Exception\InvalidUriException;
use App\Client\Exception\RequestException;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\RequestFactoryInterface as PsrRequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

abstract class AbstractRequestFactory implements  RequestFactoryInterface
{
    public function __construct(
        protected ?PsrRequestFactoryInterface $requestFactory = null
    ) {
        $this->requestFactory = $requestFactory ?? new Psr17Factory();
    }

    public function createRequest(string $method, $uri): RequestInterface
    {
        if(!in_array(strtoupper($method),HttpMethod::HTTP_METHODS))
        {
            throw new InvalidMethodException($method);
        }
        if(empty($uri) || !filter_var($uri, FILTER_VALIDATE_URL))
        {
            throw new InvalidUriException($uri);
        }
        return $this->requestFactory->createRequest($method, $uri);
    }

    public function createRequestFrom(
        string $method,
        string|UriInterface $uri,
        array $headers = [],
        StreamInterface $stream = null
    ): RequestInterface
    {
        $request = $this->createRequest($method, $uri);
      
      if(!is_null($stream))
      {
            $request = $request->withBody($stream);
            $request->getBody()->rewind();
      }  
        $request = $this->addHeadersToRequest($request, $headers);
        return $request;
    }

    public function addHeadersToRequest(RequestInterface &$request, array $headers = []): RequestInterface
    {
        foreach ($headers as $header => $value) {
           $request =  $request->withAddedHeader($header, $value);
        }

        return $request;
    }
}
