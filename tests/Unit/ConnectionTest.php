<?php

use App\Database\Connection;

it('returns a valid PDO instance', function () {
    // Arrange
    $connection = new Connection('sqlite::memory:');

    // Act
    $pdo = $connection->getPdo();

    //Assert
    expect($pdo)->toBeInstanceOf(\PDO::class);
});
