<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use Pest\Expectation;
use Pest\Support\Extendable;
use PHPUnit\Framework\TestCase;

trait ResourceShortcuts
{
    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function assertResponseIsSuccessful(): TestCase
    {
        ApiPlatform::assertResponseIsSuccessful();

        return $this;
    }

    public function assertResourceIsNotFound(): TestCase
    {
        test()->assertResponseStatusCodeSame(404);

        return $this;
    }

    public function assertResourceIsForbidden(): TestCase
    {
        test()->assertResponseStatusCodeSame(403);

        return $this;
    }

    public function assertResourceIsUnauthorized(): TestCase
    {
        test()->assertResponseStatusCodeSame(401);

        return $this;
    }

    /**
     * @return Expectation|Extendable
     */
    public function expectResponseContent()
    {
        return expect($this->responseContent());
    }
}
