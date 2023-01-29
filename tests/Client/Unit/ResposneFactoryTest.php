<?php

declare(strict_types=1);

namespace App\Tests\Client\Unit;

use App\Client\Enum\HttpStatus;
use App\Client\Factory\AbstractResposneFactory;
use App\Tests\Client\Fake\FakeResponseFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @group unit_response_factory
 * @group response_factory
 */
class ResposneFactoryTest extends TestCase
{
    public function testCreateDefaultFactory(): void
    {
        $factory = new FakeResponseFactory(
            $this->createStub(ResponseInterface::class)
        );

        $reqest = $factory->createResponse(HttpStatus::CREATED);

        $this->assertInstanceOf(AbstractResposneFactory::class, $factory);
        $this->assertInstanceOf(ResponseInterface::class, $reqest);
        $this->assertInstanceOf(Psr17Factory::class, $factory->getFactory());
    }

    public function testCreateConcretFactory(): void
    {
        $factory = new FakeResponseFactory(
            $this->createStub(ResponseInterface::class),
            $this->createStub(ResponseFactoryInterface::class)
        );

        $reqest = $factory->createResponse(HttpStatus::CREATED);

        $this->assertInstanceOf(AbstractResposneFactory::class, $factory);
        $this->assertInstanceOf(ResponseInterface::class, $reqest);
        $this->assertNotInstanceOf(Psr17Factory::class, $factory->getFactory());
    }
}
