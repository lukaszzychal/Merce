<?php

namespace App\Client\Exception;

use Psr\Http\Client\ClientExceptionInterface;

class ClientException extends \Exception implements ClientExceptionInterface
{
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }
}
