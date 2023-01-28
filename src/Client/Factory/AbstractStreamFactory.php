<?php

namespace App\Client\Factory;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class AbstractStreamFactory implements StreamFactoryInterface
{
    public function __construct(
        protected ?StreamFactoryInterface $streamFactory = null
    ) {
        $this->streamFactory = $streamFactory ?? new Psr17Factory();
    }
    public function createStream(string $content = ''): StreamInterface
    {
        return $this->streamFactory->createStream($content);
    }


    public function createStreamFromFile(string $filename, string $mode = 'r'): StreamInterface
    {
        return $this->streamFactory->createStreamFromFile($filename, $mode);
    }


    public function createStreamFromResource($resource): StreamInterface
    {
        return $this->streamFactory->createStreamFromResource($resource);
    }
}
