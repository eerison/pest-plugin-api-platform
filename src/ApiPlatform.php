<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

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
     *                                      I'm ignoring this return to be compatible with api plat form 2 and 3
     *                                      error: Eerison\PestPluginApiPlatform\ApiPlatform::createApiClient():
     *                                      Return value must be of type ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client,
     *                                      ApiPlatform\Symfony\Bundle\Test\Client returned
     * @phpstan-ignore-next-line
     */
    public static function createApiClient(array $kernelOptions = [], array $defaultOptions = [])
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
