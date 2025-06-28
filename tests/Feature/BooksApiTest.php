<?php

use App\Entity\Author;
use App\Entity\Book;
use App\Http\JsonResponse;
use App\Http\Response;
use App\Repository\AuthorMapper;
use App\Repository\BookMapper;
use Firebase\JWT\JWT;

beforeEach(function () {
    $this->migrateTestDatabase();
});

it('retrieves the correct book data from the books API', function (
    string $uri,
    array $book,
    array $author
) {
    // Arrange
    $key = $this->container->get('jwtSecretKey');

    $issuedAt = time();

    $payload = [
        'iss' => 'https://books-api.org',
        'aud' => 'https://books-api.com',
        'iat' => $issuedAt,
        'nbf' => $issuedAt,
        'exp' => $issuedAt + 3600,
        'data' => [
            'username' => 'david',
            'plan' => 'premium',
        ]
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');

    // Data fixtures
    // Create Author object
    $storedAuthor = Author::create(
        id: $author['id'],
        name: $author['name'],
        bio: $author['bio']
    );

    // AuthorMapper
    $authorMapper = new AuthorMapper($this->connection);

    // Save Author
    $authorMapper->save($storedAuthor);

    // Create Book object
    $storedBook = Book::create(
        id: $book['id'],
        title: $book['title'],
        yearPublished: $book['yearPublished'],
        author: $storedAuthor
    );

    // BookMapper
    $bookMapper = new BookMapper($this->connection);

    // Save Book
    $bookMapper->save($storedBook);;

    // Act
    $response = $this->json(method: 'GET', uri: $uri, headers: ['HTTP_AUTHORIZATION' => 'Bearer '.$jwt]); // $uri

    // Assert
    expect($response->getStatusCode())->toBeInt()->toBe(Response::HTTP_OK)
        ->and($response->getBody())->toMatchJson([
            'id' => $book['id'],  // $book
            'title' => $book['title'],
            'yearPublished' => $book['yearPublished'],
            'author' => [  // $author
                'id' => $author['id'],
                'name' => $author['name'],
                'bio' => $author['bio']
            ]
        ])
        ->and($response)->toBeInstanceOf(JsonResponse::class)
        ->and($response->getHeaders())->toMatchArray([
            'Content-Type' => 'application/json'
        ]);
})->with([
    'book 1' => [
        'uri' => '/books/1',
        'book' => [
            'id' => 1,
            'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'yearPublished' => 2008,
        ],
        'author' => [
            'id' => 1,
            'name' => 'Robert C. Martin',
            'bio' => 'This is an author'
        ]
    ],
    'book 2' => [
        'uri' => '/books/2',
        'book' => [
            'id' => 2,
            'title' => 'Refactoring: Improving the Design of Existing Code',
            'yearPublished' => 1999,
        ],
        'author' => [
            'id' => 2,
            'name' => 'Martin Fowler',
            'bio' => 'Martin\'s bio'
        ]
    ]
])->group('integration');
