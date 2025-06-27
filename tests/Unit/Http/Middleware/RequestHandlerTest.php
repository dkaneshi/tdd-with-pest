<?php

use App\Http\Middleware\RequestHandler;
use Tests\Unit\Http\Middleware\SuccessMiddleware;

beforeEach(function () {
    $this->container = include dirname(__DIR__, 4).'/config/services.php';
});

test('RequestHandler returns a correct Response', function () {
    // Arrange
    $request = \App\Http\Request::create('GET', '/some/uri');

    $requestHandler = new RequestHandler($this->container);

    $requestHandler->setMiddleware([SuccessMiddleware::class]);

    // Act
    $response = $requestHandler->handle($request);

    // Assert
    expect($response)
        ->toBeInstanceOf(\App\Http\Response::class)
        ->and($response->getStatusCode())
        ->toBe(200);

});
