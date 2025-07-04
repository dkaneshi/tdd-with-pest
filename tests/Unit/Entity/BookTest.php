<?php

use App\Entity\Author;
use App\Entity\Book;

test('a book can be created using a named constructor', function () {
    $author = Author::create(
        id: 321,
        name: 'John Doe',
        bio: 'This is a bio'
    );

    // Act
    $book = Book::create(
        id: 123,
        title: 'Test Book',
        yearPublished: 1999,
        author: $author
    );

    // Assert
    expect($book)->toBeInstanceOf(Book::class)
        ->and($book->getId())->toBe(123)
        ->and($book->title)->toBe('Test Book')
        ->and($book->yearPublished)->toBe(1999)
        ->and($book->author)->toBe($author)
        ->and($book->author->name)->toBe('John Doe')
        ->and(json_encode($book))->toMatchJson([
            'id' => 123,  // private properties won't be serialized
            'title' => 'Test Book',
            'yearPublished' => 1999,
            'author' => [
                'id' => 321,
                'name' => 'John Doe',
                'bio' => 'This is a bio'
            ]
        ]);
});
