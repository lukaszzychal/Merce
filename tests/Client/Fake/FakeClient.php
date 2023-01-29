<?php

namespace App\Tests\Client\Fake;
use App\Client\AbstractClient;
use App\Client\ResponseDTO;
use Psr\Http\Message\RequestInterface;

class FakeClient extends AbstractClient
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
