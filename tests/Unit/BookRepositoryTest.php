<?php

use App\Database\Connection;
use App\Entity\Author;
use App\Entity\Book;
use App\Repository\AuthorMapper;
use App\Repository\BookMapper;
use App\Repository\BookRepository;

beforeEach(function () {
    $this->migrateTestDatabase();
});


it('returns the correct book data by ID', function () {
    // Arrange
    $connection = $this->container->get(Connection::class);

    // Create an $author object
    $author = Author::create(
        id: null,
        name: 'A. N. Author',
        bio: 'This is an author'
    );

    // Instantiate an AuthorMapper
    $authorMapper = new AuthorMapper($connection);

    // Persist the $author
    $authorMapper->save($author);

    // Create a $book object
    $book = Book::create(
        id: null,
        title: 'A Test Book',
        yearPublished: 1999,
        author: $author
    );

    // Instantiate a BookMapper
    $bookMapper = new BookMapper($connection);

    // Persist the $book
    $bookMapper->save($book);

    $bookRepository = new BookRepository($connection);

    // Act
    $foundBook = $bookRepository->findById($book->getId());

    // Assert
    expect($foundBook)
        ->toMatchObject([
            'title' => 'A Test Book',
            'yearPublished' => 1999,
        ])
        ->and($foundBook->author)
        ->toMatchObject([
            'name' => 'A. N. Author',
            'bio' => 'This is an author'
        ]);

})->group('integration');