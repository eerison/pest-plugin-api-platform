<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use Pest\Expectation;
use Pest\Support\Extendable;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @method ResponseInterface response()
 */
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

    public function assertResourceIsBadRequest(): TestCase
    {
        test()->assertResponseStatusCodeSame(400);

        return $this;
    }

    public function assertResourceIsUnauthorized(): TestCase
    {
        test()->assertResponseStatusCodeSame(401);

        return $this;
    }

    public function assertResourceIsUnprocessableEntity(): TestCase
    {
        test()->assertResponseStatusCodeSame(422);

        return $this;
    }

    public function assertResourceIsForbidden(): TestCase
    {
        test()->assertResponseStatusCodeSame(403);

        return $this;
    }

    public function assertResourceIsNotFound(): TestCase
    {
        test()->assertResponseStatusCodeSame(404);

        return $this;
    }

    /**
     * @return Expectation|Extendable
     */
    public function expectResponseContent(bool $throw = true)
    {
        return expect($this->response()->getContent($throw));
    }
}
