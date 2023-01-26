<?php

declare(strict_types=1);

namespace App\Client\Enum;

final class HttpStatus
{
    public const STATUS_OK = 200;
    public const STATUS_CREATED = 201;
    public const STATUS_BAD_REQUEST = 400;
    public const STATUS_UNAUTHORIZED = 401;
    public const STATUS_NOT_FOUND = 404;
    public const STATUS_INTERNAL_SERVER_ERROR = 500;
}
