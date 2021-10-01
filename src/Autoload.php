<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Pest\Plugin;
use Symfony\Contracts\HttpClient\ResponseInterface;

Plugin::uses(Resource::class);
Plugin::uses(ResourceShortcuts::class);

/**
 * @param array<string> $kernelOptions
 * @param array<string> $defaultOptions
 */
function apiClient(array $kernelOptions = [], array $defaultOptions = []): Client
{
    return test()->apiClient($kernelOptions, $defaultOptions);
}

/**
 * @param array<string> $options
 */
function get(string $url, array $options = []): ResponseInterface
{
    test()->get($url, $options);

    return test()->response();
}

/**
 * @param array<string> $fields
 * @param array<string> $options
 */
function post(string $url, array $fields, array $options = []): ResponseInterface
{
    test()->post($url, $fields, $options);

    return test()->response();
}

/**
 * @param array<string> $fields
 * @param array<string> $options
 */
function put(string $url, array $fields, array $options = []): ResponseInterface
{
    test()->put($url, $fields, $options);

    return test()->response();
}

/**
 * @param array<string> $options
 */
function delete(string $url, array $options = []): ResponseInterface
{
    test()->delete($url, $options);

    return test()->response();
}

/**
 * @phpstan-ignore-next-line
 */
function findIriBy(string $resourceClass, array $criteria): ?string
{
    return ApiPlatform::instance()->findIriBy(...func_get_args());
}

function assertResponseIsSuccessful(): void
{
    test()->assertResponseIsSuccessful();
}

function assertResourceIsNotFound(): void
{
    test()->assertResourceIsNotFound();
}

function assertResourceIsUnauthorized(): void
{
    test()->assertResourceIsUnauthorized();
}

function assertResourceIsForbidden(): void
{
    test()->assertResourceIsForbidden();
}

function assertMatchesResourceCollectionJsonSchema(string $object): void
{
    ApiPlatform::assertMatchesResourceCollectionJsonSchema($object);
}

function assertMatchesResourceItemJsonSchema(string $object): void
{
    ApiPlatform::assertMatchesResourceItemJsonSchema($object);
}

expect()->extend('toMatchesResourceCollectionJsonSchema', function ($object): void {
    ApiPlatform::assertMatchesResourceCollectionJsonSchema($object);
});

expect()->extend('toMatchesResourceItemJsonSchema', function ($object): void {
    ApiPlatform::assertMatchesResourceItemJsonSchema($object);
});
