<?php

namespace App\Client\Exceptions;

use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;

class RequestException extends \Exception implements RequestExceptionInterface
{
    public function __construct(readonly private RequestInterface $request, string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
