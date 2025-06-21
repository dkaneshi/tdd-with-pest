<?php

use App\Database\Connection;
use App\Repository\BookRepository;

beforeEach(function () {
    $this->migrateTestDatabase();
});


it('returns the correct book data by ID', function () {
    // Arrange
    $bookId = 990;

    // Create an $author object

    // Instantiate an AuthorMapper

    // Persist the $author

    // Create a $book object

    // Instantiate a BookMapper

    // Persist the $book


    $connection = $this->container->get(Connection::class);
    $bookRepository = new BookRepository($connection);

    // Act
    $foundBook = $bookRepository->findById($bookId);

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