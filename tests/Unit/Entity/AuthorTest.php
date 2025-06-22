<?php

use App\Entity\Author;

test('an author can be created using a named constructor', function () {
    // Act
    $author = Author::create(
        id: 123,
        name: 'John Doe',
        bio: 'This is a bio'
    );

    // Assert
    expect($author)->toBeInstanceOf(Author::class)
        ->and($author->getId())->toBe(123)
        ->and($author->name)->toBe('John Doe')
        ->and($author->bio)->toBe('This is a bio');
});
