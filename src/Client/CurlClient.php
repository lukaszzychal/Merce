<?php

declare(strict_types=1);

namespace App\Client;
use Psr\Http\Message\RequestInterface;

class CurlClient extends AbstractClient
{    

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
  
}
