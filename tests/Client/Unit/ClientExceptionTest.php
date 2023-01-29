<?php

namespace App\Client\Unit;
use App\Client\AbstractClient;
use App\Client\Enum\HttpMethod;
use App\Client\Enum\HttpStatus;
use App\Client\Exception\ClientException;
use App\Client\Exception\InvalidMethodException;
use App\Client\Exception\InvalidUriException;
use App\Client\Exception\NetworkException;
use App\Client\Exception\RequestException;
use App\Client\ResponseDTO;
use PhpCsFixer\Fixer\FunctionNotation\VoidReturnFixer;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class ClientExceptionTest extends TestCase
{

    /**
     * @group unit_throw_exceptions
     * @return void
     * @dataProvider providerExceptionData
     */
    public function testExceptionMapping(
        \Exception  $actualExceptionObject,
        string $expectedExceptionClass,
        string $expectedExceptionMessage,           
    ): void
    {
        $clientMock = new class($actualExceptionObject) extends AbstractClient
        {
              public function __construct(
                  private \Exception $actualExceptionObject)
              {
              }
             public function execute(RequestInterface $request): ResponseDTO
             {
                throw $this->actualExceptionObject;
             }
        };
        $reqestStub = $this->createStub(RequestInterface::class);

        $this->expectException($expectedExceptionClass);
        $this->expectErrorMessage($expectedExceptionMessage);

        $clientMock->sendRequest($reqestStub);

    }



    private function providerExceptionData(): array
    {
        $requestStub = $this->createStub(RequestInterface::class);
        return [
            'RequestException to RequestException' => [ 
                new  RequestException(
                    $requestStub, 
                    'Client throw RequestException',
                    HttpStatus::BAD_REQUEST
                ), 
                RequestException::class,
                'Client throw RequestException',
            ],
            'ClientException to ClientException' => [ 
                new  ClientException(
                    'Client throw ClientException',
                    HttpStatus::BAD_REQUEST
                ), 
                ClientException::class,
                'Client throw ClientException',
            ],
            'NetworkException to NetworkException' => [ 
                new  NetworkException(
                    $requestStub, 
                    'Client throw NetworkException',
                    HttpStatus::BAD_REQUEST
                ), 
                NetworkException::class,
                'Client throw NetworkException',
            ],

            'InvalidMethodException to InvalidMethodException' => [ 
                new  InvalidMethodException(HttpMethod::GET), 
                InvalidMethodException::class,
                "Invalid HTTP METHOD. Give 'GET' use [ GET, POST, PUT, PATH, DELETE ] .",
            ],
            'InvalidUriException to InvalidUriException' => [ 
                new  InvalidUriException('invalid uri'), 
                InvalidUriException::class,
                'Invalid URI. Give \'invalid uri\' .',
            ],

            'AnyException to ClientException' => [ 
                new \LogicException('Any Exception'), 
                ClientException::class,
                'Error Client. Please try again. ',
            ],
        
        ];
    }
}
