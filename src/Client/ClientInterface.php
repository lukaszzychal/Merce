<?php

declare(strict_types=1);

namespace App\Client;

use Psr\Http\Message\ResponseInterface;

interface ClientInterface
{
    public function get(string $uri, array $options = []): ResponseInterface;
 
    // public function post(string $uri, array $options = []): ResponseInterface;
    // public function put(string $uri, array $options = []): ResponseInterface;
    // public function path(string $uri, array $options = []): ResponseInterface;
    // public function delete(string $uri, array $options = []): ResponseInterface;
    // public function options(string $uri, array $options = []): ResponseInterface;
    // public function trace(string $uri, array $options = []): ResponseInterface;
    // public function connect(string $uri, array $options = []): ResponseInterface;
  

}
