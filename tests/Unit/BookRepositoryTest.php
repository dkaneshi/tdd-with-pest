<?php

use App\Repository\BookRepository;

it('returns the correct book data by ID', function () {
    // Arrange
    $bookId = 990;
    $bookRepository = new BookRepository();

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