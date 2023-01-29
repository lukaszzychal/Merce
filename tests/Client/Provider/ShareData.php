<?php

namespace App\Tests\Client\Provider;

class ShareData
{
    public const HOST = 'https://jsonplaceholder.typicode.com';
    public const ENDPOINT = '/users/1';

    public const URI_JSON_DATA = self::HOST.self::ENDPOINT;

    public const HEADER_ACCEPT_KEY = 'Accept';


public const HEADER_ACCEPT_VALUE= 'text/html' ;

    public const HEADER_ACCEPT = [
            self::HEADER_ACCEPT_KEY =>  self::HEADER_ACCEPT_VALUE
    ];
    
    public const HEADER_ACCEPT_LANGUAGE = [
        'key' =>'Accept-Language',
        'value' => 'en-US'
    ];
    public const HEADERS =  [
        self::HEADER_ACCEPT['key'] =>  self::HEADER_ACCEPT['value'],
        self::HEADER_ACCEPT_LANGUAGE['key'] =>  self::HEADER_ACCEPT_LANGUAGE['value']           
    ];

}
