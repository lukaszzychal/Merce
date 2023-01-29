<?php

declare(strict_types=1);

namespace App\Tests\Client\Unit;

use App\Client\Factory\AbstractStreamFactory;
use App\Tests\Client\Fake\FakeStreamFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @group unit_stream_factory
 * @group stream_factory
 */
class StreamFactoryTest extends TestCase
{
    public function testUSeDefaultFactory(): void
    {
        $anyContent = 'any content';
        $anyResposne = $this->createStub(StreamInterface::class);

        $factory = new FakeStreamFactory(
            $anyResposne
        );

        $stream = $factory->createStream($anyContent);

        $this->assertInstanceOf(AbstractStreamFactory::class, $factory);
        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertInstanceOf(Psr17Factory::class, $factory->getFactory());
    }

    public function testUseConcretFactory(): void
    {
        $anyContent = 'any content';
        $anyResposne = $this->createStub(StreamInterface::class);

        $concretStreaFactory = $this->createStub(StreamFactoryInterface::class);

        $factory = new FakeStreamFactory(
            $anyResposne,
            $concretStreaFactory
        );
        $stream = $factory->createStream($anyContent);

        $this->assertInstanceOf(AbstractStreamFactory::class, $factory);
        $this->assertInstanceOf(StreamInterface::class, $stream);
        $this->assertNotInstanceOf(Psr17Factory::class, $factory->getFactory());
    }
}
