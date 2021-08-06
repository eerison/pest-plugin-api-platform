<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @property ResponseInterface $request
 */
trait ResourceShortcuts
{
    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function assertResponseIsSuccessful(): TestCase
    {
        expect($this->request->getStatusCode())
            ->toBeGreaterThanOrEqual(200)
            ->toBeLessThan(300)
        ;

        return $this;
    }

    public function assertResourceIsNotFound(): TestCase
    {
        expect($this->request->getStatusCode())->toEqual(404);

        return $this;
    }

    public function assertResourceIsForbidden(): TestCase
    {
        expect($this->request->getStatusCode())->toEqual(403);

        return $this;
    }

    public function assertResourceIsUnauthorized(): TestCase
    {
        expect($this->request->getStatusCode())->toEqual(401);

        return $this;
    }
}
