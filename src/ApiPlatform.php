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
    /**
     * @param array<string> $kernelOptions
     * @param array<string> $defaultOptions
     */
    public static function createApiClient(array $kernelOptions = [], array $defaultOptions = []): Client
    {
        return parent::createClient($kernelOptions, $defaultOptions);
    }
}
