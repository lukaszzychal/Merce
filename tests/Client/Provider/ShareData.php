<?php

namespace App\Tests\Client\Provider;

class ShareData
{
    public const HOST = 'http://localhost';

    public const HEADER_ACCEPT = [
        'key' =>'Accept',
        'value' => 'text/html'
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
