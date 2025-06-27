<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\MiddlewareInterface;
use App\Http\Middleware\RequestHandlerInterface;
use App\Http\Response;

class SuccessMiddleware implements MiddlewareInterface
{
    public function process($request, $handler, RequestHandlerInterface $handler): Response
    {
        return new Response('Success', 200);
    }

}