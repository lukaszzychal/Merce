<?php
declare(strict_types=1);
namespace App\Tests\Client\Fake;

use App\Client\Factory\AbstractStreamFactory;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class FakeStreamFactory extends AbstractStreamFactory
{
    public function __construct(private StreamInterface $stream, ?StreamFactoryInterface $streamFactory = null)
    {
        parent::__construct($streamFactory);
    }
    public function createResponse(int $code = 200, string $reasonPhrase = ''): StreamInterface
    {
        return $this->stream;
    }

   public function getFactory(): StreamFactoryInterface
   {
       return $this->streamFactory;
   }
}
