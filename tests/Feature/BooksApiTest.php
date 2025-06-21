<?php

use App\Http\Response;

it('retrieves the correct book 1 data from the books API', function () {

    // Arrange

    // Act
    $response = $this->json(method: 'GET', uri: '/books/1');

    // Assert
    expect($response->getStatusCode())->toBeInt()->toBe(Response::HTTP_OK)
        ->and($response->getBody())->toMatchJson([
            'id' => 1,
            'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'yearPublished' => 2008,
            'author' => [
                'id' => 1,
                'name' => 'Robert C. Martin',
                'bio' => 'This is an author'
            ]
        ]);
});

it('retrieves the correct book 2 data from the books API', function () {

    // Arrange

    // Act
    $response = $this->json(method: 'GET', uri: '/books/2');

    // Assert
    expect($response->getStatusCode())->toBeInt()->toBe(Response::HTTP_OK)
        ->and($response->getBody())->toMatchJson([
            'id' => 2,
            'title' => 'Refactoring: Improving the Design of Existing Code',
            'yearPublished' => 1999,
            'author' => [
                'id' => 2,
                'name' => 'Martin Fowler',
                'bio' => 'Martin\'s bio'
            ]
        ]);
});
