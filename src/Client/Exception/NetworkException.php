<?php

namespace App\Client\Exception;

use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestInterface;

class NetworkException extends \Exception implements NetworkExceptionInterface
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
