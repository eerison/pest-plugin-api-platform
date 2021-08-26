<?php

declare(strict_types=1);

namespace Eerison\PestPluginApiPlatform;

use Pest\Plugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\ResponseInterface;

Plugin::uses(Resource::class);
Plugin::uses(ResourceShortcuts::class);

/**
 * @param array<string> $options
 */
function get(string $url, array $options = []): ResponseInterface
{
    return ApiPlatform::createApiClient()->request(Request::METHOD_GET, $url, $options);
}

/**
 * @param array<string> $options
 */
function post(string $url, array $options = []): ResponseInterface
{
    return ApiPlatform::createApiClient()->request(Request::METHOD_POST, $url, $options);
}

/**
 * @param array<string> $options
 */
function put(string $url, array $options = []): ResponseInterface
{
    return ApiPlatform::createApiClient()->request(Request::METHOD_PUT, $url, $options);
}

/**
 * @param array<string> $options
 */
function delete(string $url, array $options = []): ResponseInterface
{
    return ApiPlatform::createApiClient()->request(Request::METHOD_DELETE, $url, $options);
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
