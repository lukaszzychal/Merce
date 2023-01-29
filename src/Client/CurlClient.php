<?php

declare(strict_types=1);

namespace App\Client;
use App\Client\Enum\HttpStatus;
use App\Client\Exception\NetworkException;
use Psr\Http\Message\RequestInterface;

class CurlClient extends AbstractClient
{    

     public function execute(RequestInterface $request): ResponseDTO
    {
    //     $defaults_options = [
    //         CURLOPT_URL => (string) $request->getUri(),

    //         CURLOPT_HEADER => 0,
    
    //         CURLOPT_RETURNTRANSFER => TRUE,
    
    //         CURLOPT_TIMEOUT => 4
    //     ];
        

    // $ch = curl_init();
    // curl_setopt_array($ch, $defaults_options);
    // $result = curl_exec($ch);
    // if($result === false){
    //         throw new NetworkException(
    //             $request, 
    //             'Client curl can not return resoult. Try again.',
    //             HttpStatus::BAD_REQUEST
    //         );
    // }
    // curl_close($ch);
    //     // var_dump($result);
        // die();
        return new ResponseDTO(
            200,
             'any Reason Phrase ',
              $result, 
               [
                'content-type' => 'aplication/json'
            ]
        );
    }
  
    function curl_post($url, array $post = NULL, array $options = array())

{

    $defaults = array(

        CURLOPT_POST => 1,

        CURLOPT_HEADER => 0,

        CURLOPT_URL => $url,

        CURLOPT_FRESH_CONNECT => 1,

        CURLOPT_RETURNTRANSFER => 1,

        CURLOPT_FORBID_REUSE => 1,

        CURLOPT_TIMEOUT => 4,

        CURLOPT_POSTFIELDS => http_build_query($post)

    );



    $ch = curl_init();

    curl_setopt_array($ch, ($options + $defaults));

    if( ! $result = curl_exec($ch))

    {

        trigger_error(curl_error($ch));

    }

    curl_close($ch);

    return $result;

}



/**

 * Send a GET requst using cURL

 * @param string $url to request

 * @param array $get values to send

 * @param array $options for cURL

 * @return string

 */

function curl_get($url, array $get = NULL, array $options = [])

{    

    $defaults = array(

        CURLOPT_URL => $url,

        CURLOPT_HEADER => 0,

        CURLOPT_RETURNTRANSFER => TRUE,

        CURLOPT_TIMEOUT => 4

    );

    

    $ch = curl_init();

    curl_setopt_array($ch, ($options + $defaults));

    if( ! $result = curl_exec($ch))

    {

        trigger_error(curl_error($ch));

    }

    curl_close($ch);

    return $result;

}


}
