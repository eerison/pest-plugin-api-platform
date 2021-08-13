<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @internal
 */
trait Resource
{
    private ResponseInterface $response;

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function get(string $url, array $options = []): TestCase
    {
        $this->response = ApiPlatform::createApiClient()->request('GET', $url, $options);

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
