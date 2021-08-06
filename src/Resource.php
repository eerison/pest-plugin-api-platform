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
    private ResponseInterface $request;

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function get(string $url, array $options = []): TestCase
    {
        $this->request = ApiPlatform::createApiClient()->request('GET', $url, $options);

        return $this;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function assertStatus(int $statusCode): TestCase
    {
        expect($this->request->getStatusCode())->toEqual($statusCode);

        return $this;
    }
}
