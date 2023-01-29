<?php

namespace App\Client\Exception;


class InvalidUriException extends \Exception
{
    public function __construct(string $uri)
    {
        parent::__construct(sprintf('Invalid URI. Give \'%s\' .', $uri));
    }
}
