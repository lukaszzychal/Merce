<?php

declare(strict_types=1);

namespace App\Client\Enum;

final class HttpMethod
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATH = 'PATH';
    public const DELETE = 'DELETE';

    public const HTTP_METHODS = [
        self::GET, self::POST, self::PUT, self::PATH, self::DELETE
    ];
}
