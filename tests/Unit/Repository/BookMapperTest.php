<?php

use App\Entity\Author;
use App\Entity\Book;
use App\Repository\AuthorMapper;
use App\Repository\BookMapper;

beforeEach(function () {
    $this->migrateTestDatabase();
});

it('saves a Book to the database', function () {
    $author = Author::create(null, 'Alan Turing', 'A math genius');
    $authorMapper = new AuthorMapper($this->connection);
    $authorMapper->save($author);

    $book = Book::create(null, 'A Test Book', 1999, $author);
    $bookMapper = new BookMapper($this->connection);
    $bookMapper->save($book);

    $this->assertDatabaseHas('books', [
        'title' => 'A Test Book',
        'year_published' => 1999,
        'author_id' => $author->getId(),
    ]);
})->group('integration');
