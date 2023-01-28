<?php

declare(strict_types=1);

namespace App\Tests\Client\Integration;

use App\Client\Factory\AbstractStreamFactory;
use App\Client\Factory\ProxyStreamFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

/**
 * @group inte_stream_factory
 * @group stream_factory
 */
class StreamFactoryTest extends TestCase
{
    private const ANY_CONTENT = 'any content';
    public function testUseDefaultFactory(): void
    {
        $factory = new ProxyStreamFactory();

        $stream = $factory->createStream(self::ANY_CONTENT);

        $this->assertInstanceOf(AbstractStreamFactory::class, $factory);
        $this->assertInstanceOf(StreamInterface::class, $stream);
    }

    public function testUseConcretFactory(): void
    {
        $factory = new ProxyStreamFactory(
            new Psr17Factory()
        );

        $stream = $factory->createStream(self::ANY_CONTENT);

        $this->assertInstanceOf(AbstractStreamFactory::class, $factory);
        $this->assertInstanceOf(StreamInterface::class, $stream);
    }
}
