<?php

use App\Controller\BooksController;
use App\Routing\RouteHandlerResolver;

beforeEach(function () {
    $this->container = include dirname(__DIR__, 3) . '/config/services.php';
});

it('resolves the correct route handler closure', function () {
    // Arrange
    $routeHandlerResolver = new RouteHandlerResolver($this->container);
    $handlerInfo = fn() => 'foo';

    // Act
    $handler = $routeHandlerResolver->resolve($handlerInfo);

    // Assert
    expect($handler)
        ->toBeCallable()
        ->toBe($handlerInfo);
});

it('resolves the correct route handler controller', function () {
    // Arrange
    $routeHandlerResolver = new RouteHandlerResolver($this->container);
    $handlerInfo = [BooksController::class, 'show'];

    // Act
    $handler = $routeHandlerResolver->resolve($handlerInfo);

    // Assert
    expect($handler)
        ->toBeCallable()
        ->and($handler[0])
        ->toBeInstanceOf(BooksController::class);
});

