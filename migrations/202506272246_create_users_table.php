<?php

use App\Database\MigrationInterface;

return new class implements MigrationInterface
{
    public function up(PDO $pdo): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    username TEXT UNIQUE NOT NULL CHECK(LENGTH(username) <= 50),
                    password TEXT NOT NULL CHECK(LENGTH(password) >= 60),
                    plan TEXT NOT NULL
                );";

        $pdo->exec($sql);
    }

    public function down(PDO $pdo): void
    {
        $sql = "DROP TABLE IF EXISTS users;";

        $pdo->exec($sql);
    }
};
