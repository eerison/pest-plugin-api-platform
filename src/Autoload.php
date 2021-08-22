<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use Pest\Plugin;
use Symfony\Contracts\HttpClient\ResponseInterface;

Plugin::uses(Resource::class);
Plugin::uses(ResourceShortcuts::class);

/**
 * @param array<string> $options
 */
function get(string $url, array $options = []): ResponseInterface
{
    return ApiPlatform::createApiClient()->request('GET', $url, $options);
}

expect()->extend('toMatchesResourceCollectionJsonSchema', function ($object): void {
    ApiPlatform::assertMatchesResourceCollectionJsonSchema($object);
});

expect()->extend('toMatchesResourceItemJsonSchema', function ($object): void {
    ApiPlatform::assertMatchesResourceItemJsonSchema($object);
});
