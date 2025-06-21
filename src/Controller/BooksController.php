<?php

namespace App\Controller;

use App\Http\Response;

class BooksController
{

    public function show(int $id): Response
    {
        $body = '{"id":1,"title":"Clean Code: A Handbook of Agile Software Craftsmanship",
            "year_published":2008,"author":{"id":1,"name":"Robert C. Martin","bio":"This is an author"}}';

        return new Response(body: $body);
    }
}