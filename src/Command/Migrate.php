<?php

declare(strict_types=1);

namespace App\Command;

use App\Database\Connection;
use App\Database\MigrationInterface;
use PDOException;

class Migrate implements CommandInterface
{
    public function __construct(
        private Connection $connection,
        private string $migrationsFolder
    )
    {}

    public function execute(): void
    {
        // Obtain PDO
        $pdo = $this->connection->getPdo();

        // Open a try / catch - need to roll back if failures...no half-migrated states
        try {
            // Begin a transaction
            $pdo->beginTransaction();

            $files = scandir($this->migrationsFolder);

            // Loop through files in the migrations folder
            foreach ($files as $file) {

                if ($file === '.' || $file === '..') {
                    continue;
                }

                // Include the file
                $migration = include $this->migrationsFolder . '/' . $file;

                // Check that it is a migration
                if (! $migration instanceof MigrationInterface) {
                    continue;
                }

                // Call the up method
                $migration->up($pdo);

            }
            // Commit transaction
            $pdo->commit();

        // Catch an exception and roll back
        } catch (PDOException $exception) {
            // Roll back the transaction
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            throw $exception;
        }
    }

}