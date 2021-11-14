Api platform for Pest
=====================

This package adds [Api platform](https://api-platform.com/) testing capabilities to **[Pest](https://pestphp.com)**.

## Installation

You can install the package via composer:

```bash
composer require eerison/pest-plugin-api-platform --dev
```

Add `uses(ApiTestCase::class)` in your `tests/Pest.php`

```php
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

uses(ApiTestCase::class)->beforeEach(fn() => static::bootKernel())->in('Feature');
```

## Usage

```php
it('is checking the body structure')
    ->group('response')
    ->get('/foo/response/200')
    ->expectResponseContent()
        ->json()
        ->toHaveKey('name', 'Erison')
        ->toHaveKey('company.name', 'Fake company');
```

or you can use importing the function

```php
use function Eerison\PestPluginApiPlatform\get;

it('is checking the body structure using context.', function () {
    $responseContent = get('/foo/response/200')->getContent();

    expect($responseContent)
        ->json()
        ->toHaveKey('company.address')
    ;
});
```

using `findIriBy`

```php
use function Eerison\PestPluginApiPlatform\{get, findIriBy};

it('can use findIriBy', function () {
    $iri = findIriBy(YourEntity::class, ['yourField' => 'yourValue']);
    $responseContent = get($iri)->getContent();

    expect($responseContent)
        ->json()
        ->toHaveKey('company.address')
    ;
});
```

using snapshot (please install [pest-plugin-snapshots](https://github.com/spatie/pest-plugin-snapshots#installation))

```php
it('can be used with snapshot')
    ->group('response')
    ->get('/foo/response/200')
    ->expectResponseContent()
    ->json()
    ->toMatchJsonSnapshot();
```

## Converting api platform test in pest

Before

```php
<?php
// api/tests/BooksTest.php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\Book;

class BooksTest extends ApiTestCase
{
    // This trait provided by AliceBundle will take care of refreshing the database content to a known state before each test
    use RefreshDatabaseTrait;
    
    public function testGetCollection(): void
    {
        // The client implements Symfony HttpClient's `HttpClientInterface`, and the response `ResponseInterface`
        $response = static::createClient()->request('GET', '/books');

        $this->assertResponseIsSuccessful();

        // Asserts that the returned JSON is a superset of this one
        $this->assertJsonContains([
            '@context' => '/contexts/Book',
            '@id' => '/books',
            '@type' => 'hydra:Collection',
            'hydra:totalItems' => 100,
            'hydra:view' => [
                '@id' => '/books?page=1',
                '@type' => 'hydra:PartialCollectionView',
                'hydra:first' => '/books?page=1',
                'hydra:last' => '/books?page=4',
                'hydra:next' => '/books?page=2',
            ],
        ]);

        // Asserts that the returned JSON is validated by the JSON Schema generated for this resource by API Platform
        // This generated JSON Schema is also used in the OpenAPI spec!
        $this->assertMatchesResourceCollectionJsonSchema(Book::class);
    }
```

After

```php
use App\Entity\Book;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;

uses(RefreshDatabaseTrait::class);

it('can get a collection')
    ->get('/books')
    ->assertResponseIsSuccessful()
    ->expectResponseContent()
        ->json()
        ->toHaveKey('@context', '/contexts/Book')
        ->toHaveKey('@id', '/books')
        ->toHaveKey('@type', 'hydra:Collection')
        ->toHaveKey('hydra:totalItems', 100)
        ->toHaveKey('hydra:view.@id', '/books?page=1')
        ->toHaveKey('hydra:view.@type', 'hydra:PartialCollectionView')
        ->toHaveKey('hydra:first', '/books?page=1')
        ->toHaveKey('hydra:last', '/books?page=4')
        ->toHaveKey('hydra:next', '/books?page=2')
        ->toMatchesResourceCollectionJsonSchema(Book::class)
        ;
```

Expectations
- `toMatchesResourceCollectionJsonSchema(Your::class)`
- `toMatchesResourceItemJsonSchema(Your::class)`

Functions
- `apiClient()`
- `get()`
- `post()`
- `put()`
- `delete()`
- `findIriBy()`
- `assertResponseIsSuccessful()`
- `assertResourceIsBadRequest()`
- `assertResourceIsNotFound()`
- `assertResourceIsUnauthorized()`
- `assertResourceIsForbidden()`
- `assertMatchesResourceItemJsonSchema(Your::class)`
- `assertMatchesResourceCollectionJsonSchema(Your::class)`
- `assertResourceIsBadRequest()`
- `assertResourceIsUnprocessableEntity()`
- `expectResponseContent()`

> if you want to test `expectResponseContent` and not return an exception pass `false` as parameter, example: `expectResponseContent(false)`




## Testing

``` bash
composer test
```

## Credits

- [Nuno Maduro](https://github.com/nunomaduro)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
