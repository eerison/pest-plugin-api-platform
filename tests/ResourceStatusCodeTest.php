<?php

use function Eerison\PestPluginApiPlatform\assertResourceIsBadRequest;
use function Eerison\PestPluginApiPlatform\assertResourceIsForbidden;
use function Eerison\PestPluginApiPlatform\assertResourceIsNotFound;
use function Eerison\PestPluginApiPlatform\assertResourceIsUnauthorized;
use function Eerison\PestPluginApiPlatform\assertResponseIsSuccessful;
use function Eerison\PestPluginApiPlatform\assertResponseStatusCodeSame;
use function Eerison\PestPluginApiPlatform\get;

it('can get resource with status code 200.')
    ->get('/foo/response/200')
    ->assertResponseIsSuccessful()
    ->group('foo');

it('can get resource with status code 201.')
    ->get('/foo/response/201')
    ->assertResponseIsSuccessful()
    ->group('foo')
;

it('can get resource with status code 202.')
    ->get('/foo/response/202')
    ->assertResponseIsSuccessful()
    ->group('foo')
;

it('can get resource with status code 203.')
    ->get('/foo/response/203')
    ->assertResponseIsSuccessful()
    ->group('foo')
;

it('can get resource with status code 204.')
    ->get('/foo/response/204')
    ->assertResponseIsSuccessful()
    ->group('foo')
;

test('assertResponseStatusCodeSame method')
    ->get('/foo/response/400')
    ->assertResponseStatusCodeSame(400);

test('assertResourceIsBadRequest method')
    ->get('/foo/response/400')
    ->assertResourceIsBadRequest();

it('can use assertResponseIsSuccessful as function', function () {
    get('/foo/response/204');
    assertResponseIsSuccessful();
});

it('expect a not found status code from foo resource.')
    ->get('/foo/response/404')
    ->assertResourceIsNotFound()
    ->group('foo')
;

it('can use assertResourceIsNotFound as function', function () {
    get('/foo/response/404');
    assertResourceIsNotFound();
});

it('expect an unauthorized status code from foo resource.')
    ->get('/foo/response/401')
    ->assertResourceIsUnauthorized()
    ->group('bar')
;

it('can use assertResourceIsUnauthorized as function', function () {
    get('/foo/response/401');
    assertResourceIsUnauthorized();
});

it('expect a forbidden status code from foo resource.')
    ->get('/foo/response/403')
    ->assertResourceIsForbidden()
    ->group('foo')
;

it('can use assertResourceIsForbidden as function', function () {
    get('/foo/response/403');
    assertResourceIsForbidden();
});

test('assertResponseStatusCodeSame method.', function () {
    get('/foo/response/403');
    assertResponseStatusCodeSame(403);
});

test('bad request function.', function () {
    get('/foo/response/400');
    assertResourceIsBadRequest();
});
