<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @internal
 */
trait Resource
{
    private ResponseInterface $response;

    /**
     * @param array<string> $kernelOptions
     * @param array<string> $defaultOptions
     */
    public function apiClient(array $kernelOptions = [], array $defaultOptions = []): Client
    {
        return ApiPlatform::createApiClient($kernelOptions, $defaultOptions);
    }

    public function get(string $url, array $options = []): TestCase
    {
        $this->response = ApiPlatform::createApiClient()->request(Request::METHOD_GET, $url, $options);

        return $this;
    }

    public function post(string $url, array $fields, array $options = []): TestCase
    {
        $options['json'] = $fields;
        $this->response  = ApiPlatform::createApiClient()->request(Request::METHOD_POST, $url, $options);

        return $this;
    }

    public function put(string $url, array $fields, array $options = []): TestCase
    {
        $options['json'] = $fields;
        $this->response  = ApiPlatform::createApiClient()->request(Request::METHOD_PUT, $url, $options);

        return $this;
    }

    public function delete(string $url, array $options = []): TestCase
    {
        $this->response = ApiPlatform::createApiClient()->request(Request::METHOD_DELETE, $url, $options);

        return $this;
    }

    public function assertResponseStatusCodeSame(int $statusCode): TestCase
    {
        ApiPlatform::assertResponseStatusCodeSame($statusCode);

        return $this;
    }

    public function response(): ResponseInterface
    {
        return $this->response;
    }
}
