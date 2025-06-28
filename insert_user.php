<?php

declare(strict_types=1);

// Get Firebase JWT

// Autoloading
use App\Database\Connection;

require 'vendor/autoload.php';

// Container
$container = require 'config/services.php';

// Get username and password
$username = $argv[1];
$password = password_hash($argv[2], PASSWORD_DEFAULT);
$plan = 'premium';

// PDO
/** @var PDO $pdo */
$pdo = $container->get(Connection::class)->getPdo();

try {
    $pdo->beginTransaction();
    // Prepare stmt
    $stmt = $pdo->prepare("INSERT INTO users (username, password, plan) VALUES (:username, :password, :plan)");

    // Execute the statement + fetch
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $password);
    $stmt->bindValue(':plan', $plan);
    $stmt->execute();

    $pdo->commit();
    echo 'User created';
} catch (\Exception $exception) {
    $pdo->rollBack();
    echo $exception->getMessage();
}

