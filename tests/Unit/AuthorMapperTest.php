<?php

use App\Entity\Author;
use App\Repository\AuthorMapper;

beforeEach(function () {
    $this->migrateTestDatabase();
});

it('saves an Author to the database', function () {
    // Arrange
    // Create $author and $authorMapper
    $author = Author::create(null, 'Alan Turing', 'A math genius');
    $authorMapper = new AuthorMapper($this->connection);

    // Act
    // Save the author
    $authorMapper->save($author);

    // Assert that it is in the database
    $this->assertDatabaseHas('authors', [
        'name' => 'Alan Turing',
        'bio' => 'A math genius'
    ]);

});
