<?php

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

it('expect a not found status code from foo resource.')
    ->get('/foo/response/404')
    ->assertResourceIsNotFound()
    ->group('foo')
;

it('expect an unauthorized status code from foo resource.')
    ->get('/foo/response/401')
    ->assertResourceIsUnauthorized()
    ->group('bar')
;

it('expect a forbidden status code from foo resource.')
    ->get('/foo/response/403')
    ->assertResourceIsForbidden()
    ->group('foo')
;
