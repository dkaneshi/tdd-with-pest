<?php

use App\Http\Middleware\JwtAuthenticate;
use App\Http\Middleware\RequestHandlerInterface;

test('JWT authentication produces the correct response', function () {
    // Arrange
    $request = \App\Http\Request::create(
        'GET',
        '/some/uri',
        ['HTTP_AUTHORIZATION' => 'Bearer some.fake.token'],
    );

    // Middleware
    $jwtAuth = new JwtAuthenticate('some-secret-key');

    // RequestHandlerInterface
    $requestHandler = Mockery::mock(RequestHandlerInterface::class);

    // Act
    // Middleware process()
    $response = $jwtAuth->process($request, $requestHandler);

    // Assert
    expect($response)
        ->toBeInstanceOf(\App\Http\Response::class)
        ->and($response->getStatusCode())
        ->toBe(401)
        ->and($response->getHeaders()['WWW-Authenticate'])
        ->toBe('Bearer error="invalid_token"');
});
