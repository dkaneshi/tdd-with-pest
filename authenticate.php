<?php

declare(strict_types=1);

// Get Firebase JWT

// Autoloading
use App\Database\Connection;
use Firebase\JWT\JWT;

require 'vendor/autoload.php';

// Container
$container = require 'config/services.php';

// Get username and password
$username = $argv[1];
$password = $argv[2];

// PDO
/** @var PDO $pdo */
$pdo = $container->get(Connection::class)->getPdo();

// Prepare stmt
$stmt = $pdo->prepare("SELECT password, plan FROM users WHERE username = ?");

// Execute the statement + fetch
$stmt->execute([$username]);

$user = $stmt->fetch();

// Verify password
$authenticated = password_verify($password, $user['password']);

// Exit if is not authenticated
if (! $authenticated) {
    die('Authentication failed');
}

// Generate a key (add .env and container at the end of the lesson)
$key = $container->get('jwtSecretKey');

// Create issued at
$issuedAt = time();

// Create payload
$payload = [
    'iss' => 'https://books-api.org',
    'aud' => 'https://books-api.com',
    'iat' => $issuedAt,
    'nbf' => $issuedAt,
    'data' => [
        'username' => $username,
        'plan' => $user['plan']
    ]
];

// JWT::encode
// (this will JSON encode payload then bas65urlencoded header + payload and sign using secret key)
$jwt = JWT::encode($payload, $key, 'HS256');

// Return the JWT to the client
echo $jwt;