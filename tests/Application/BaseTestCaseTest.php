<?php

namespace App\Tests\Application;

use App\Client\ClientInterface;
use App\Client\CurlClient;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;

class BaseTestCaseTest extends TestCase
{
    private ClientInterface $client;
    protected function setUp(): void
    {
        parent::setUp();
        $factory = new Psr17Factory();
        $this->client = new CurlClient($factory, $factory);
    }
}
