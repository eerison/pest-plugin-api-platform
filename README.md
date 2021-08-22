Api platform for Pest
=====================

This package adds [Api platform](https://api-platform.com/) testing capabilities to **[Pest](https://pestphp.com)**.

## Installation

You can install the package via composer:

```bash
composer require eerison/pest-plugin-api-platform --dev
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

List of expectations 

- `findIriBy()` ("expectations" is not implemented yet)
- `assertResponseIsSuccessful()`
- `assertResourceIsNotFound()`
- `assertResourceIsUnauthorized()`
- `assertResourceIsForbidden()`
- `toMatchesResourceCollectionJsonSchema(Your::class)`
- `toMatchesResourceItemJsonSchema(Your::class)`
- `assertMatchesResourceItemJsonSchema(Your::class)`
- `assertMatchesResourceCollectionJsonSchema(Your::class)`

## Testing

``` bash
composer test
```

## Credits

- [Nuno Maduro](https://github.com/nunomaduro)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
