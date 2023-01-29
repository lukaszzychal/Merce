<?php

namespace App\Client\Exception;
use App\Client\Enum\HttpMethod;

class InvalidMethodException extends \Exception
{
    public function __construct(string $method)
    {
        parent::__construct(
            sprintf(
                'Invalid HTTP METHOD. Give \'%s\' use [ %s ] .',
                $method,
                implode(', ',HttpMethod::HTTP_METHODS)
            )
        );
    }
}
