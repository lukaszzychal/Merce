<?php

declare(strict_types=1);

namespace App\Tests\Client\Integration;

use App\Client\Enum\HttpStatus;
use App\Client\Factory\AbstractResposneFactory;
use App\Client\Factory\ProxyResposneFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @group inte_response_factory
  * @group response_factory
 */
class ResponseFactoryTest extends TestCase
{
    public function testUseDefaultFactory(): void
    {
        $factory = new ProxyResposneFactory();

        $reqest = $factory->createResponse(HttpStatus::CREATED);

        $this->assertInstanceOf(AbstractResposneFactory::class, $factory);
        $this->assertInstanceOf(ResponseInterface::class, $reqest);
    }

    public function testUseConcretFactory(): void
    {
        $factory = new ProxyResposneFactory(
            new Psr17Factory()
        );

        $reqest = $factory->createResponse(HttpStatus::CREATED);

        $this->assertInstanceOf(AbstractResposneFactory::class, $factory);
        $this->assertInstanceOf(ResponseInterface::class, $reqest);
    }
}
