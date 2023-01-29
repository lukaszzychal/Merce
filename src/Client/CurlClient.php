<?php

declare(strict_types=1);

namespace App\Client;
use App\Client\Enum\HttpMethod;
use App\Client\Enum\HttpStatus;
use App\Client\Exception\NetworkException;
use Psr\Http\Message\RequestInterface;

class CurlClient extends AbstractClient
{    

     public function execute(RequestInterface $request): ResponseDTO
    {
        $defaults_options = [
            CURLOPT_URL => (string) $request->getUri(),

            CURLOPT_HEADER => 0,
    
            CURLOPT_RETURNTRANSFER => TRUE,
    
            CURLOPT_TIMEOUT => 4
        ];
        

    $handle = curl_init();
    if(!$handle){
        throw new NetworkException(
            $request, 
            'Client curl can not return resoult. Try again.',
            HttpStatus::BAD_REQUEST
        );
}
    curl_setopt($handle, CURLINFO_HEADER_OUT, true);

        $curl_method = match ($request->getMethod()) {
            HttpMethod::POST => [CURLOPT_POST => true],
            HttpMethod::GET => [CURLOPT_HTTPGET => true],
            HttpMethod::PUT => [CURLOPT_PUT => true],
            default => [CURLOPT_HTTPGET => true]
        };
     
        $defaults_options = $defaults_options + $curl_method;

    curl_setopt_array($handle, $defaults_options);
    $result = curl_exec($handle);
    if($result === false){
            throw new NetworkException(
                $request, 
                'Client curl can not return resoult. Try again.',
                HttpStatus::BAD_REQUEST
            );
    }
    
        $http_code = curl_getinfo($handle, CURLINFO_RESPONSE_CODE);

        $http_headers = curl_getinfo($handle, CURLINFO_HEADER_OUT);
   
        curl_close($handle);

        return new ResponseDTO(
            $http_code,
             ' ',
              $result, 
               $this->parseHeadersCurl($http_headers)
        );
    }
  
    private function parseHeadersCurl(string|bool $http_headers): array 
    {
        return []; // @todo to do later
    }


}
