<?php

namespace App\Client;

class ResponseDTO
{
    public function __construct(
   readonly public int $codeStatus, 
   readonly public string $reasonPhrase, 
   readonly public string $body,
   readonly  public string $protocolVersion,
   readonly  public array $headers = []
       )
   {
       
   }
}
