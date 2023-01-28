<?php

declare(strict_types=1);

namespace App\Tests\Client\Application;

use App\Client\ClientInterface;
use App\Client\CurlClient;
use App\Client\Factory\ProxyFactory;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected ClientInterface $client;
    protected function setUp(): void
    {
        parent::setUp();
        $proxyFatory = new ProxyFactory();
        $this->client = new CurlClient($proxyFatory);
    }
}
