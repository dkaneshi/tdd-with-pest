# TDD With Pest

A RESTful API for books and authors built using Test-Driven Development (TDD) with the Pest PHP testing framework. This application was created following the [Test Driven PHP](https://garyclarketech.teachable.com/l/pdp/test-driven-php) video course by Gary Clarke.

## Description

This is a simple RESTful API that allows you to retrieve information about books and their authors. The application demonstrates the use of TDD principles with Pest PHP, a testing framework built on top of PHPUnit.

## Features

- RESTful API for retrieving book information
- Books have associated authors
- SQLite database for data storage
- Custom routing system using FastRoute
- Dependency injection using League Container

## Technologies & Packages

### Production Dependencies
- **ext-pdo**: PHP Data Objects for database access
- **nikic/fast-route**: Fast request router for PHP
- **league/container**: Dependency injection container

### Development Dependencies
- **pestphp/pest**: Elegant PHP testing framework
- **symfony/var-dumper**: Variable dumper component
- **mockery/mockery**: Mock object framework for testing

## Installation

1. Clone the repository:
   ```
   git clone https://github.com/yourusername/tdd-with-pest.git
   cd tdd-with-pest
   ```

2. Install dependencies:
   ```
   composer install
   ```

3. The SQLite database is already included in the `db` directory. If you need to recreate it, you can use the following schema:
   ```sql
   CREATE TABLE authors (
       id INTEGER PRIMARY KEY,
       name TEXT NOT NULL,
       bio TEXT NOT NULL
   );

   CREATE TABLE books (
       id INTEGER PRIMARY KEY,
       title TEXT NOT NULL,
       year_published INTEGER NOT NULL,
       author_id INTEGER NOT NULL,
       FOREIGN KEY (author_id) REFERENCES authors (id)
   );
   ```

## Running Tests

You can run the tests using Pest:

```
composer test
```

Or directly:

```
./vendor/bin/pest
```

## API Endpoints

- `GET /books/{id}`: Retrieve a book by ID

## Development

This project follows TDD principles. When adding new features:

1. Write a failing test
2. Write the minimum code to make the test pass
3. Refactor the code while keeping the tests passing
