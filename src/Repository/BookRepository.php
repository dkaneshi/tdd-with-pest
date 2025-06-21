<?php

namespace App\Repository;

use App\Entity\Book;

class BookRepository
{
    public function findById(int $id): ?Book
    {
        // Retrieve the book data frm teh database

        // Use ti to create and hydrate a Book
        $book = Book::create();

        // return the Book
        return $book;
    }

}