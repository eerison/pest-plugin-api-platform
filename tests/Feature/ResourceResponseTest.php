<?php

use function Eerison\PestPluginApiPlatform\apiClient;
use function Eerison\PestPluginApiPlatform\get;

it('is checking the body structure')
    ->group('response')
    ->get('/foo/response/200')
    ->expectResponseContent()
        ->json()
        ->toHaveKey('name', 'Erison')
        ->toHaveKey('company.name', 'Fake company');

it('can be used with snapshot')
    ->group('response')
    ->get('/foo/response/200')
    ->expectResponseContent()
    ->json()
    ->toMatchJsonSnapshot();

it('is checking the body structure using context.', function () {
    $responseContent = get('/foo/response/200')->getContent();

    expect($responseContent)
        ->json()
        ->toHaveKey('company.address')
    ;
});

it('can use apiClient', function () {
    $apiClient = apiClient();

    $response = $apiClient->request('GET', '/foo/response/200');
    $content = $response->getContent();

    expect($content)
        ->json()
        ->toHaveKey('company.address')
    ;
});
