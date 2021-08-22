<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

/**
 * @internal
 * @phpstan-ignore-next-line
 */
final class ApiPlatform extends ApiTestCase
{
    private static ?ApiPlatform $instance = null;

    /**
     * @param array<string> $kernelOptions
     * @param array<string> $defaultOptions
     */
    public static function createApiClient(array $kernelOptions = [], array $defaultOptions = []): Client
    {
        return parent::createClient($kernelOptions, $defaultOptions);
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function findIriBy(string $resourceClass, array $criteria): ?string
    {
        return parent::findIriBy($resourceClass, $criteria);
    }

    public static function instance(): ApiPlatform
    {
        if (null === ApiPlatform::$instance) {
            ApiPlatform::$instance = new ApiPlatform();
        }

        return ApiPlatform::$instance;
    }
}
