<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @internal
 */
trait Resource
{
    private ResponseInterface $response;

    public function get(string $url, array $options = []): TestCase
    {
        $this->response = ApiPlatform::createApiClient()->request(Request::METHOD_GET, $url, $options);

        return $this;
    }

    public function post(string $url, array $options = []): TestCase
    {
        $this->response = ApiPlatform::createApiClient()->request(Request::METHOD_POST, $url, $options);

        return $this;
    }

    public function put(string $url, array $options = []): TestCase
    {
        $this->response = ApiPlatform::createApiClient()->request(Request::METHOD_PUT, $url, $options);

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

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     */
    public function responseContent(): string
    {
        return $this->response->getContent();
    }
}
